document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('darkModeToggle');
    const isDarkMode = localStorage.getItem('darkMode') === 'enabled';

    // تفعيل الوضع الليلي إذا كان محفوظًا
    if (isDarkMode) {
        document.body.classList.add('dark-mode');
        toggleButton.textContent = '☀️';
    }

    // تغيير الوضع عند النقر على الزر
    toggleButton.addEventListener('click', () => { 
        document.body.classList.toggle('dark-mode');
        const isDark = document.body.classList.contains('dark-mode');
        toggleButton.textContent = isDark ? '☀️' : '🌙';

        // حفظ الوضع في localStorage
        localStorage.setItem('darkMode', isDark ? 'enabled' : 'disabled');
    });
});
