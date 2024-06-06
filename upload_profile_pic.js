document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('photo-upload').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
            const profilePic = document.getElementById('profile-pic');
            profilePic.src = e.target.result;
        }
        
        reader.readAsDataURL(file);
    });
});
