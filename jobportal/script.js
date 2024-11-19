 
// Add any JavaScript functions here as needed
document.addEventListener("DOMContentLoaded", function() {
    // Example: Smooth scrolling for anchor links
    const links = document.querySelectorAll('a[href^="#"]');
    for (const link of links) {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            target.scrollIntoView({
                behavior: 'smooth'
            });
        });
    }
});
