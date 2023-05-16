// Get all the checkboxes on the page
let checkboxes = document.querySelectorAll('input[type="checkbox"]');

// Get the button element
let button = document.querySelector('#delete');

// Attach an event listener to the button element
button.addEventListener('click', function() {
  // Create an empty array to store the checked checkbox values
  let checkedValues = [];

  // Loop through each checkbox and add its value to the checkedValues array if it is checked
  checkboxes.forEach(function(checkbox) {
    if (checkbox.checked) {
      checkedValues.push(checkbox.value);
    }
  });

  let xhr = new XMLHttpRequest();
  xhr.open('POST', '/object.php');
  xhr.setRequestHeader('Content-Type', 'application/json');
  let data = JSON.stringify({ ids: checkedValues, action: 'delete' });

  xhr.send(data);

  xhr.addEventListener('loadend', function() {
    console.log(xhr);
    window.location = xhr.responseURL;
  });
});

let deleteButtons = document.querySelectorAll('a[object_type][object_id]');
deleteButtons.forEach(function(button) {
  button.addEventListener('click', function() {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/object.php');
    xhr.setRequestHeader('Content-Type', 'application/json');
    let data = JSON.stringify({ ids: [button.getAttribute('object_id')], action: 'delete'});
    xhr.send(data);

    // Update the page
    xhr.addEventListener('loadend', function() {
      console.log(xhr);
      window.location = xhr.responseURL;
    });
  });
});

function toggleSelect(source) {
  checkboxes = document.getElementsByName('select');
  for (var i = 0, n = checkboxes.length; i < n; i++) {
      checkboxes[i].checked = source.checked;
  }
}

function toggleToast(source) {
  source.classList.remove('active');
  // Delete 'message' parameter from URL
  let url = window.location.href;
  let urlParams = new URLSearchParams(window.location.search);
  urlParams.delete('message');
  // Update URL
  window.history.replaceState({}, '', `${url.split('?')[0]}?${urlParams.toString()}`);
}