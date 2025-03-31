## MLP To-Do List Application

### System Requirements

- **PHP**: ^8.2
- **MySQL**: 5.7+ or MariaDB 10.3+

#### Laravel Version
- Laravel 12.0
- Livewire (for dynamic components)

### How to Run the Application

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd mlp-to-do-list
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Set up environment file**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   - Update the `.env` file with your MySQL database credentials:
     ```
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=mlp_todo
     DB_USERNAME=your_username
     DB_PASSWORD=your_password
     ```
   - Create a database named `mlp_todo` (or your preferred name)

5. **Run database migrations**
   ```bash
   php artisan migrate
   ```

6. **Install frontend dependencies**
   ```bash
   npm install
   ```

7. **Build frontend assets**
   ```bash
   npm run build
   ```

8. **Start the development server**
   ```bash
   php artisan serve
   ```

9. **Access the application**
   - Open your browser and navigate to: `http://localhost:8000`

---

## MLP To-DO - Instructions

You must demonstrate the following abilities/skills: make models, controllers, migrations, HTML, CSS, blade, Git commits, blade templates, etc.

**1. Fork this repo**

**2. Build front-end**

Layout must be as follows:

![Alt text](assets/site-layout.png?raw=true "Title")
Please note that the above image and logo are in the 'assets' folder.

**3. Build To-Do list functionality**

     A user should be able to
     * Create a task.
     * Delete a task.
     * Mark a task as completed.


**Good Luck !!! Once done, please send us the link of your repo.**
