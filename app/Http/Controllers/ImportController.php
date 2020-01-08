<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Contact;
use App\Events\FileUpload;
use App\Events\ContactsRetrieved;
use Illuminate\Support\Facades\Schema;
use File;

class ImportController extends Controller {
  public function fileUpload(Request $request) {
    $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    $out->writeln("got csv file upload: ");
    if ($request->hasFile('csv_file')) {
      $out->writeln("We have a file! Horray!");
      $path = $request->file('csv_file')->store('csv_files');
      //$csv_file = file($path);
      //$data = array_map('csv_file'); // ERROR is here <- need to open file differently?
      $uploadedFile = $request->file('csv_file');
      // is the csv file above in an array?
      $csv_array = $this->csvToArray(storage_path('app/' . $path));
      //$out->print_r($csv_array);
      $contact_import_count = 0;
      $csv_headers = [];
      $index = 0;
      $sample_contact = [];
      // Get the headers and first contact
      foreach($csv_array[0] as $key => $val) {
        $csv_headers[$index] = $key;
        $sample_contact[$index] = $val;
        $index++;
      }
      // Get the contact count
      foreach($csv_array as $contactArray) {
        $contact_import_count++;
        foreach($contactArray as $header => $contact) {
          $out->writeln("key: ".$header." val: ".$contact);
        }
      }

      foreach($csv_headers as $header) {
        $out->writeln("header: ".$header);
      }
      foreach($sample_contact as $element) {
        $out->writeln("element: ".$element);
      }
      $out->writeln("count: ".$contact_import_count);
      $uploadedFileId = $path;

      //$contact_import_count = count($csv_array);
      event(new FileUpload(compact('csv_headers', 'sample_contact', 'contact_import_count', 'uploadedFileId')));
      return response()->json('uploaded',200);
    } else {
      return response()->json('upload failed', 409);
    }
  }

  public function commitMapping(Request $request) {
    $out = new \Symfony\Component\Console\Output\ConsoleOutput();

    // pull out mapping array from request
    $mapping = $request->input('mapping');

    // pull out csvFileId from request
    $uploadedFileId = $request->input('uploadedFileId');

    $mappingString = implode(',', $mapping);
    $out->writeln("Mapping we got is: ".$mappingString);
    $out->writeln("CSV ID we got is: ".$uploadedFileId);

    // load csv file from disk
    // convert csv to array (without headers)
    $csvArray = $this->csvToArray(storage_path('app/' . $uploadedFileId));

    $mappedContacts = $this->mapContacts($csvArray, $mapping);

    foreach($mappedContacts[0] as $key=>$val) {
      $out->writeln("Final Mapping - key: ".$key." val: ".$val);
    }

    foreach($mappedContacts as $contact) {
      $newContact = Contact::create($contact);
      $newContact->save();
    }
    // respond to the client with OK if all went well
    $contacts = Contact::all();
    event(broadcast(new ContactsRetrieved($contacts)));

    return response()->json('imported', 200);
  }

  public function mapContacts($contacts, $mapping) {
    $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    $columnNames = Schema::getColumnListing('contacts');
    array_shift($columnNames);

    $mappedContacts = [];
    // Loop through each of the contacts to be mapped
    foreach($mapping as $key=>$val) {
      $out->writeln("Mapping - key: ".$key." val: ".$val);
    }

    foreach($contacts as $contactKey=>$contact) {
      $mappedContact = [];
      $custom_attributes = [];
      $indexCounter = 0;
      // Loop through each field in this contact
      foreach($contact as $fieldKey=>$field) {
        // add each field to the mappedContact at the index set in mapping
        $mappedIndex = $mapping[$indexCounter];
        // if mappedIndex is not set, add this fieldKey and field to custom_attributes
        if ($mappedIndex == -1) {
          $custom_attributes[$fieldKey] = $field;
        } else {
          $mappedIndexFieldName = $columnNames[$mappedIndex];
          $mappedContact[$mappedIndexFieldName] = $field;
        }

        $indexCounter++;
      }
      // Convert cusotm_attributes to JSON and push to mappedContact
      $custom_attributes_json = json_encode($custom_attributes);
      $mappedContact['custom_attributes'] = $custom_attributes_json;

      $mappedContacts[$contactKey] = $mappedContact;
    }

    return $mappedContacts;
  }

  public function csvToArray($filename = '', $delimiter = ',') {
    $out = new \Symfony\Component\Console\Output\ConsoleOutput();
    $out->writeln("Filename we got is: ".$filename);

    if (!file_exists($filename) || !is_readable($filename)) {
      $out->writeln("File not readable or doesnt exist");
      return false;
    }

    $out->writeln("Beginning processing of CSV file");
    $header = null;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== false) {
      while (($row = fgetcsv($handle, 1000, $delimiter)) !== false) {
        if (!$header) {
          $header = $row;
          //$out->writeln('row: '.$row);
        } else {
          $data[] = array_combine($header, $row);
          $out->writeln('header: '.$header[0].'  '.$header[1]);
        }
      }
      fclose($handle);
    }

    return $data;
  }
}
