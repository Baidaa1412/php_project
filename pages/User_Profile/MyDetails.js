
// -----------------SideBar--------------
const menu_toggle = document.querySelector('.menu-toggle');
const sidebar = document.querySelector('.sidebar');

menu_toggle.addEventListener('click', () => {
  menu_toggle.classList.toggle('is-active');
  sidebar.classList.toggle('is-active');
});

// -----------------SideBar--------------


// -----------------Nav-----------------

const toggleButton = document.getElementsByClassName('toggle-button')[0]
const navbarLinks = document.getElementsByClassName('navbar-links')[0]

toggleButton.addEventListener('click', () => {
  navbarLinks.classList.toggle('active')
})

// -----------------Nav-----------------


// MyDetails.js

// Function to handle the form submission and update user information
function saveChanges() {
  const form = document.querySelector('form'); // Get the form element
  form.addEventListener('submit', async (event) => {
    event.preventDefault(); // Prevent the default form submission

    // Serialize form data into URL-encoded format
    const formData = new URLSearchParams(new FormData(form));

    try {
      // Send a POST request to the server with the updated data
      const response = await fetch('update.php', {
        method: 'POST',
        body: formData,
      });

      if (response.ok) {
        // Redirect to the same page after successful update
        window.location.reload();
      } else {
        console.error('Update failed.');
      }
    } catch (error) {
      console.error('An error occurred:', error);
    }
  });
}

// Call the function to initialize the form submission handling
saveChanges();
