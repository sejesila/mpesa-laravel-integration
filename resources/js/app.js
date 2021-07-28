const { default: axios } = require('axios');
require('./bootstrap');
document.getElementById('getAccessToken').addEventListener('click', (e) => {
    e.preventDefault()
    axios.post('/get-token', {})
        .then((response) => {
            console.log(response.data)
            document.getElementById('access_token').innerHTML = response.data;
        })
        .catch((error) => {
            console.log(error)
        })

})
document.getElementById('registerURLS').addEventListener('click', (e) => {
    e.preventDefault()
    axios.post('/register-urls', {})
        .then((response) => {
            if(response.data.ResponseDescription){
            document.getElementById('response').innerHTML = response.data.ResponseDescription
        } else {
            document.getElementById('response').innerHTML = response.data.errorMessage
        }
        console.log(response.data);

        })
        .catch((error) => {
            console.log(error)
        })
})
document.getElementById(`simulatec2b`).addEventListener('click',(e)=>{
    e.preventDefault()
    const requestBody ={
        amount: document.getElementById('amount').value,
        account: document.getElementById('account').value
    }
    axios.post('/simulate-c2b',requestBody)
        .then((response)=>{
            console.log(response.data)
        })
        .catch((error)=>{
            console.log(error)
        })

})
