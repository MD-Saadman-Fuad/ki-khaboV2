**Ki Khabo — Food Ordering Website**

- **Overview**: Ki Khabo is a simple PHP/MySQL based food ordering website with a public-facing frontend for browsing categories and foods, searching, and placing orders, plus an admin panel for managing admins, categories, foods and orders.


**Main Technologies**
- **Backend**: PHP (vanilla)
- **Database**: MySQL
- **Frontend**: HTML, CSS, Tailwind CSS (via CDN), minimal JavaScript
- **Server stack**: XAMPP / Apache + MySQL (recommended for local development)

**Main Features**
- **Public**: Browse categories (`categories.php`), view foods (`foods.php`), search foods (`food-search.php`), place orders (`order.php`), contact page (`contact.php`).
- **Admin panel**: Add, update, delete and manage admins, categories and foods; manage orders; secure admin login/logout and change password. Files in the `admin/` folder expose these features (e.g., `admin/add-food.php`, `admin/manage-order.php`).

**Dependencies**
- **Runtime**: PHP (recommended PHP 7.4+), MySQL.
- **Libraries**: Tailwind CSS (loaded via CDN in `partials-frontend/menu.php`).
- **No Composer packages** or Node build tools are required by default.

**Configuration**
- The app uses `config/constants.php` for site constants and DB credentials. Default values in the repository:
  - `SITEURL`: `http://localhost/ki-khaboV2/`
  - `DB_HOST`: `localhost`
  - `DB_USERNAME`: `root`
  - `DB_PASSWORD`: `` (empty)
  - `DB_NAME`: `ki-khabo`

If your local database or user differs, update `config/constants.php` accordingly.

**Run Locally (Windows, using XAMPP)**
1. Install XAMPP from https://www.apachefriends.org/ and start **Apache** and **MySQL**.
2. Copy the project folder to `C:\xampp\htdocs\` so the site path becomes `C:\xampp\htdocs\ki-khaboV2` (or clone directly into that folder).
3. Open phpMyAdmin at `http://localhost/phpmyadmin` and create a new database named `ki-khabo` (or another name — if you choose another name, update `config/constants.php`).
4. If you have a SQL dump for this project, import it via phpMyAdmin > Import. (There is no SQL file included in this repository.)
5. Visit the site in your browser at `http://localhost/ki-khaboV2/`.
6. Admin panel is at `http://localhost/ki-khaboV2/admin/` (use the admin credentials from your DB; if none exist, create an admin user in the `admin` table via phpMyAdmin).

**Common Troubleshooting**
- If you see DB connection errors, verify `DB_USERNAME`, `DB_PASSWORD`, and `DB_NAME` in `config/constants.php`.
- If assets (images/CSS) do not load, confirm `SITEURL` is correct and files exist under `images/` and `css/`.

**Live / Relevant Links**
- **Local site (default)**: `http://localhost/ki-khaboV2/`
- **Admin panel**: `http://localhost/ki-khaboV2/admin/`
- **GitHub repo**: https://github.com/MD-Saadman-Fuad/ki-khaboV2

**How to add a screenshot**
- Take a screenshot of the site in your browser and save it as `images/screenshot.png` inside the project.
- The README will display it automatically using the relative path `images/screenshot.png`.

If you want, I can:
- Add a starter SQL schema (I can draft basic table structures for categories, food, admin, orders) — tell me if you want that.
- Add a real screenshot by taking one from your running site (you'd need to run it and provide the image), or I can use an existing image from `images/` as a temporary screenshot.

Enjoy — tell me what you'd like done next (generate DB schema, add fixtures, or commit changes).