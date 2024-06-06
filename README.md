
# PinFood

PinFood is the ultimate destination for food lovers of all kinds. Whether you're searching for delectable desserts, speedy quick meals, wholesome vegetarian dishes, or world cuisines, PinFood has you covered. With a user-friendly platform designed for easy recipe sharing and exploration, PinFood is your go-to place for culinary inspiration.

## Features

- **Search Bar:** Easily search for recipes, cooking tips, or specific ingredients using our prominently displayed search bar.
- **Create Post:** Share your culinary creations with the PinFood community by uploading photos, adding titles, and including descriptions or cooking tips.
- **Create Recipe:** Share your favorite recipes with detailed instructions, ingredients, and photos.
- **Save Post:** Save posts to your personal collections for easy access later, organizing them into themed collections like "Weeknight Dinners" or "Special Occasions."
- **Love and Comment on a Post:** Express appreciation for posts by liking them and leaving comments to share thoughts or feedback.
- **Share Post:** Share posts with friends and followers outside of the PinFood platform using built-in sharing functionality.
- **Notifications:** Receive notifications for various activities, keeping you updated on engagement and interactions within the platform.

## Target Audience

PinFood caters to a diverse audience, including:

- Food lovers who enjoy exploring and trying new recipes.
- Home cooks seeking meal ideas and practical cooking tips.
- Professional chefs looking to share their recipes, skills, and discoveries.
- Food bloggers interested in sharing their content and engaging with a broader audience.
- Baking enthusiasts eager to discover and share baking recipes and techniques.
- Health-conscious individuals searching for nutritious recipes aligned with their dietary preferences and health goals.

## Getting Started

### Prerequisites

- PHP 7.x or higher
- MySQL
- Composer (for dependency management)
- A web server like Apache or Nginx

### Installation

1. **Clone the repository:**

   ```bash
   git clonehttps://github.com/your-username/PinFood.git](https://github.com/MariahBugeja/reset.git)
   cd PinFood
   ```

2. **Install dependencies:**

   ```bash
   composer install
   ```

3. **Database setup:**

   - Create a new MySQL database.
   - Import the SQL file located in the `database` folder to create the necessary tables.



4. **Run the application:**

   - Start your web server and navigate to the project directory.
   - Access the application via your web browser.

## Folder Structure

```
PinFood/
├── assets/           # Images, logos, and other static assets
├── database/         # SQL files for database setup
├── includes/         # header
├── uploads/          # User-related  uploads recipe and posts
├── Users/            # User-related PHP scripts
├── db_connection.php # Database connection script
├── db_functions.php  # Database helper functions
├── index.php         # Main entry point of the application
├── loginpage.php     # User login page
├── signuppage.php     # User sign up page
├── README.md         # Project README file
```

## Main Files

- `index.php`: Main entry point of the application.
- `login.php`: User login functionality.
- `register.php`: User registration functionality.
- `account.php`: User profile page.
- `view_pin.php`: View pin details and comments.
- `db_connection.php`: Database connection setup.
- `db_functions.php`: Helper functions for database operations.
- 
## Usage Instructions

1. **Creating a Recipe:** Click on the "Recipe" icon and fill in the details including ingredients, instructions, and photo.
2. **Creating a post:** Click on the "Create " word and fill in the details including title,description, type of food, and photo.
3. **Saving a Post:** Click on the "Save" button next to heart to save it to your account.
4. **love a Post:** Click on the "heart" button next to the save button to save it to your account.
5. **Commenting on a Post:** Type your comment in the comment box below a post and click "Submit" to leave a comment.
6. **Sharing a Post:** Click on the "Share" button and choose your preferred platform to share the post with others.

## Contributing

1. Fork the repository.
2. Create your feature branch (`git checkout -b feature/my-new-feature`).
3. Commit your changes (`git commit -am 'Add some feature'`).
4. Push to the branch (`git push origin feature/my-new-feature`).
5. Create a new Pull Request.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

If you have any questions or feedback, feel free to reach out to us at [mariahbugeja82@gmail.com].

```
