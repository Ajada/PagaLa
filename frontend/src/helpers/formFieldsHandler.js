export function setFormFieldsError (fieldsErrors = [], elementWithSpans) {
  let domElements
  if (elementWithSpans) {
    domElements = document.getElementById(elementWithSpans)
  } else {
    domElements = document.getElementById('form-fields')
  }

  const spanFields = domElements.querySelectorAll('span')

  fieldsErrors.forEach(fieldError => {
    spanFields.forEach(field => {
      if (field.getAttribute('name') == fieldError.name) {
        field.innerText = fieldError.msg
      } else if (fieldsErrors.map(fieldError => fieldError.name).includes(field.getAttribute('name'))) {} else { field.innerText = '' }
    })
  })
}

export function cleanFormField (fieldName, elementWithSpans) {
  let domElements
  if (elementWithSpans) {
    domElements = document.getElementById(elementWithSpans)
  } else {
    domElements = document.getElementById('form-fields')
  }

  const spanFields = domElements.querySelectorAll('span')

  spanFields.forEach(field => {
    if (field.getAttribute('name') == fieldName) {
      field.innerText = ''
    }
  })
}
