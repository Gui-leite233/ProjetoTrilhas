document.addEventListener('DOMContentLoaded', function() {
    const MAX_CHARS = 150; // Maximum characters before truncating

    document.querySelectorAll('.description').forEach(description => {
        const text = description.textContent.trim();
        
        if (text.length > MAX_CHARS) {
            const truncated = text.substring(0, MAX_CHARS);
            description.classList.add('truncated');
            
            // Create leia mais button only if text is longer than MAX_CHARS
            const leiaButton = document.createElement('button');
            leiaButton.className = 'leia-mais-btn';
            leiaButton.innerHTML = '<span>Leia mais</span><i class="fas fa-chevron-down"></i>';
            description.parentNode.insertBefore(leiaButton, description.nextSibling);
        }
    });

    document.querySelectorAll('.leia-mais-btn').forEach(button => {
        button.addEventListener('click', function() {
            const card = this.closest('.card');
            const description = card.querySelector('.description');
            
            card.classList.toggle('expanded');
            description.classList.toggle('truncated');
            
            if (card.classList.contains('expanded')) {
                this.innerHTML = '<span>Leia menos</span><i class="fas fa-chevron-up"></i>';
            } else {
                this.innerHTML = '<span>Leia mais</span><i class="fas fa-chevron-down"></i>';
            }
        });
    });
});
