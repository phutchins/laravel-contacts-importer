<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
  protected $fillable = [
    'team_id',
    'first_name',
    'last_name',
    'email',
    'phone',
    'sticky_phone_number_id',
    'twitter_id',
    'fb_messenger_id',
    'unsubscribed_status',
    'custom_attributes'
  ];

  protected $attributes = [
    'id' => null,
    'team_id' => '',
    'first_name' => '',
    'last_name' => '',
    'email' => '',
    'phone' => '',
    'sticky_phone_number_id' => '',
    'twitter_id' => '',
    'fb_messenger_id' => '',
    'unsubscribed_status' => false,
    'custom_attributes' => ''
  ];
}
