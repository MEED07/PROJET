# إنشاء ملفات CSS مع الكود المعدل
css_files = {
    "updated_index.css": """
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;800;900&family=Outfit:wght@100;200;500;600;900&family=Poppins:wght@300;400;500&family=Raleway:wght@600;900&display=swap');
    *{
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }
    body.dark-mode {
        background-color: #121212;
        color: #ffffff;
    }
    a.dark-mode {
        color: #1e90ff;
    }
    .card.dark-mode {
        background-color: #ffffff;
        color: #000000;
    }
    nav.dark-mode {
        background-color: #1c1c1c;
        color: #ffffff;
    }
    .product.dark-mode {
        background-color: #ffffff;
        color: #000000;
    }
    """,
    "updated_nav_1.css": """
    @import url('https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;800;900&family=Outfit:wght@100;200;500;600;900&family=Poppins:wght@300;400;500&family=Raleway:wght@600;900&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        position: fixed;
        background-color: white;
        top: 0;
        width: 100%;
        z-index: 1000;
        box-shadow: 0 1px 5px rgba(0, 0, 0, 0.1);
    }

    .navbar.dark-mode {
        background-color: #1c1c1c;
        color: #ffffff;
    }
    """
}

# كتابة الملفات إلى نظام الملفات
for filename, content in css_files.items():
    with open(filename, "w") as file:
        file.write(content)

print("تم إنشاء الملفات المعدلة بنجاح!")
