# ResumeBuilder

ResumeBuilder is a native PHP application that enables users to create, customize, and download professional resumes with ease. The project is simple yet powerful, providing a clean user interface and options to customize the resume layout and content.

## Features

- **User-friendly interface:** Build resumes quickly using an intuitive UI.
- **Customization options:** Edit sections like personal details, work experience, education, and skills.
- **PDF download:** Export the resume in PDF format for easy sharing.
- **Responsive design:** Works well across all devices (desktops, tablets, and mobiles).

## Installation

To get started with ResumeBuilder on your local machine, follow the steps below.

### Prerequisites

- [PHP](https://www.php.net/) (>= 7.4)
- A local server environment like [XAMPP](https://www.apachefriends.org/) or [MAMP](https://www.mamp.info/).

### Steps

1. **Clone the repository:**

   ```bash
   git clone https://github.com/LorentzaZweena/resumeBuilder.git
   cd resumeBuilder
   ```

2. **Set up the environment:**

   Ensure your local environment is set up to run PHP. If you are using XAMPP, place the project folder inside the `htdocs` directory.

3. **Create a database:**

   Set up a MySQL database for the application using phpMyAdmin or a similar tool. Import the provided SQL file (`database.sql`) located in the `database` directory to set up the necessary tables.

4. **Configure database connection:**

   In the root directory, open the `config.php` file and update the database credentials to match your local environment:

   ```php
   <?php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');
   define('DB_NAME', 'resume_builder');
   ?>
   ```

5. **Run the project:**

   Start your local server (e.g., XAMPP or MAMP) and open your browser. Navigate to:

   ```bash
   http://localhost/resumeBuilder
   ```

   This will load the ResumeBuilder homepage.

## Usage

1. **Start Building:**
   - Open the ResumeBuilder homepage and input your personal information, including name, contact details, work experience, education, and skills.

2. **Customize:**
   - Customize your resume by selecting which sections to include and modify the layout based on the available options.

3. **Download:**
   - Once you're happy with the resume, click the "Download" button to generate and download a PDF version.

## Contributing

If you'd like to contribute to the project, follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or bug fix.
3. Commit your changes and push them to your forked repository.
4. Submit a pull request explaining your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

If you have any questions, feel free to reach out to [ariva02zweena@gmail.com](mailto:ariva02zweena@gmail.com).
```
