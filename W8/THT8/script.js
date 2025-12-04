document.addEventListener('DOMContentLoaded', function() {
    
    // Ambil elemen
    const contactForm = document.getElementById('contactForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const messageInput = document.getElementById('message');
    
    const errorName = document.getElementById('errorName');
    const errorEmail = document.getElementById('errorEmail');
    const errorMessage = document.getElementById('errorMessage');
    
    const successMessage = document.getElementById('successMessage');

    // Event Listener pada saat form disubmit
    contactForm.addEventListener('submit', function(event) {
        
        // Mencegah Reload Default
        event.preventDefault();

        let isValid = true;

        function showError(input, errorTextElement) {
            input.classList.add('border-red-500');
            input.classList.remove('border-gray-300');
            // Munculkan teks error
            errorTextElement.classList.remove('hidden');
        }

        function clearError(input, errorTextElement) {
            input.classList.remove('border-red-500');
            input.classList.add('border-gray-300');
            // Sembunyikan teks error
            errorTextElement.classList.add('hidden');
        }

        // Validasi Input Logic
        // Validasi Nama
        if (nameInput.value.trim() === "") {
            showError(nameInput, errorName);
            isValid = false;
        } else {
            clearError(nameInput, errorName);
        }

        // Validasi Email
        if (emailInput.value.trim() === "") {
            showError(emailInput, errorEmail);
            isValid = false;
        } else {
            if (!emailInput.value.includes('@')) { 
                // cukup dengna @ simple
               clearError(emailInput, errorEmail);
            } else {
               clearError(emailInput, errorEmail);
            }
        }

        // Validasi Pesan
        if (messageInput.value.trim() === "") {
            showError(messageInput, errorMessage);
            isValid = false;
        } else {
            clearError(messageInput, errorMessage);
        }

        // Skenario Berhasil
        if (isValid) {
            successMessage.classList.remove('hidden');
            contactForm.reset();
            console.log("Form submitted successfully!");
        }
    });
});