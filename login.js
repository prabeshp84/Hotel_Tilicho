document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('signup-button').addEventListener('click', () => {
        window.location.href = 'signup.html'; // Redirect to the sign-up page
    });

    // Add event listener for form submission
    document.querySelector('form').addEventListener('submit', (event) => {
        event.preventDefault(); // Prevent default form submission

        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        MyLoginLibrary.login(username, password)
            .then(data => {
                if (data.status === 'success') {
                    // Handle successful login, e.g., redirect to another page
                    window.location.href = 'dashboard.html'; // Example redirect
                } else {
                    // Handle login failure
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Login failed:', error);
                alert('An error occurred. Please try again.');
            });
    });
});

// Define a namespace to encapsulate our library
const MyLoginLibrary = (function() {
    // Private function to handle the actual HTTP request
    function sendRequest(url, data) {
        return fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        });
    }

    // Public function to handle login
    function login(username, password) {
        const url = 'login.php'; // URL to your server endpoint
        const data = {
            username: username,
            password: password
        };

        return sendRequest(url, data);
    }

    // Expose public functions
    return {
        login: login
    };
})();
