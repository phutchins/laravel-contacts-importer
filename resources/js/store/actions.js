let actions = {
  ADD_CONTACT({commit}, contact) {
    axios.post('/api/contacts', contact).then(res => {
      if (res.data === "added")
        console.log('ok')
    }).catch(err => {
      console.log(err.response)
    })
  },
  DELETE_CONTACT({commit}, contact) {
    axios.delete('/api/contacts/${contact.id}')
    .then(res => {
      if (res.data === 'deleted')
        console.log('deleted')
    }).catch(err => {
      console.log(err.response)
    })
  },
  GET_CONTACT({commit}, contact) {
    axios.get('/api/contacts/${contact.id}')
    .then(res => {
      if (res.data === 'retrieved')
        console.log('retrieved')
    }).catch(err => {
      console.log(err.response)
    });
  },
  GET_CONTACTS({commit}) {
    axios.get('/api/contacts')
    .then(res => {
      {
        console.log("Data found: ", res.data)
      }
    }).catch(err => {
      console.log(err.response)
    });
  },
  COMMIT_MAPPING({commit}, data) {
    axios.post('/api/mapping', data)
    .then(res => {
      if (res.data === 'comitted')
        console.log('mapping committed!');
    }).catch(err => {
      console.log(err.response)
    });
  },
  UPLOAD_FILE({commit}, data) {
    axios.post('/api/upload', data, {
      headers: {
        'Content-Type': 'multipart/form-data'
      }
    })
    .then(res => {
      if (res.data === "uploaded")
        console.log('file upload ok!');
    }).catch(err => {
      console.log("Error uploading file: ", err.response)
    });
  },
}
export default actions
