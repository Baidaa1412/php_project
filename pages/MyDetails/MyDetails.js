const menu_toggle = document.querySelector('.menu-toggle');
const sidebar = document.querySelector('.sidebar');

menu_toggle.addEventListener('click', () => {
  menu_toggle.classList.toggle('is-active');
  sidebar.classList.toggle('is-active');
});

// -----------------Nav-----------------

const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]

toggleButton.addEventListener('click', () => {
  navbarLinks.classList.toggle('active')
})

// -----------------Nav-----------------

// ------------------------Edit Info----------------------
      let editingField = null;

      function editField(field) {
          if (editingField !== null) {
              // Cancel the ongoing edit
              cancelEdit();
          }
      
          editingField = field;
          const fieldValue = document.getElementById(field).textContent;
          document.getElementById(field).innerHTML = `<input type="text" id="${field}-input" value="${fieldValue}">`;
          document.getElementById('button2').style.display = 'inline';
      }
      
      function cancelEdit() {
          if (editingField !== null) {
              const fieldValue = document.getElementById(`${editingField}-input`).value;
              document.getElementById(editingField).textContent = fieldValue;
              editingField = null;
              document.getElementById('button2').style.display = 'none';
          }
      }
      
      function saveChanges() {
          if (editingField !== null) {
              const fieldValue = document.getElementById(`${editingField}-input`).value;
              document.getElementById(editingField).textContent = fieldValue;
              editingField = null;
          }
      }
      
// ------------------------/Edit Info----------------------



// ---------------------------Edit Bio-------------------------
// script.js
let isEditMode = false;

function toggleEditMode() {
    const textarea = document.getElementById("userbio");
    const editButton = document.getElementById("editButton");
    const saveButton = document.getElementById("saveButton");

    if (!isEditMode) {
        textarea.removeAttribute("readonly");
        editButton.style.display = "none";
        saveButton.style.display = "inline";
    } else {
        textarea.setAttribute("readonly", "true");
        editButton.style.display = "inline";
        saveButton.style.display = "none";
    }

    isEditMode = !isEditMode;
}

function saveChanges() {
    const textarea = document.getElementById("userbio");
    const newBio = textarea.value;
    // You can perform further actions with the new bio, such as saving it to a database.
    
    toggleEditMode();
}
// ---------------------------Edit Bio-------------------------



/* ------------------------Change Image Div--------------------- */

const imageIcon = document.getElementById('image-icon');
const changeButton = document.getElementById('change-button');
const imageInput = document.getElementById('image-input');

changeButton.addEventListener('click', () => {
  imageInput.click();
});

imageInput.addEventListener('change', (event) => {
  const selectedImage = event.target.files[0];

  if (selectedImage) {
    const imageUrl = URL.createObjectURL(selectedImage);
    imageIcon.src = imageUrl;
  }
});

/* ------------------------/Change Image Div--------------------- */
