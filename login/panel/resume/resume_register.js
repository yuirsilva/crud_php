// Tel Input
let input = document.querySelector('#phone')
const errorMsg = document.querySelector('#error-msg')

let iti = window.intlTelInput(input, {
    preferredCountries: ['br', 'us'],
    utilsScript: '../tel-input/utils.js',
})

const reset = () =>
{
    errorMsg.classList.add('iti-hide')
    input.classList.remove('valid-num', 'error-num')
}

input.addEventListener('blur', () =>
{
    reset()
    if(input.value.trim())
    {
        if(iti.isValidNumber())
        {
            input.classList.add('valid-num')
        }
        else
        {
            errorMsg.classList.remove('iti-hide')
            input.classList.add('error-num')
        }
    }
})

let state = null

const form = document.forms.resume
form.onsubmit = (event) =>
{
    state = iti.isValidNumber()
    if(state !== true)
    {
        errorMsg.classList.remove('iti-hide')
        event.preventDefault()
    }
}