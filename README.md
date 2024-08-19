# Eventify

Eventify is a Laravel application designed to help you manage events with ease. 

## Features

* **Event Creation:** Easily create new events with detailed information, including title, description, date, time, location, and more.
* **Ticket Management:** Define different ticket types, set prices, and manage ticket sales.
* **Participant Registration:** Allow users to register for events and purchase tickets securely.
* **Event Calendar:** Visualize upcoming and past events on a user-friendly calendar.
* **Email Notifications:** Send automated email notifications to participants about event updates, reminders, and confirmations.
* **Admin Dashboard:** Provides a comprehensive overview of event statistics, ticket sales, and participant data.

## Getting Started

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/eventify.git
   ```

2. **Install dependencies:**
   ```bash
   cd eventify
   composer install
   ```

3. **Configure the database:**
   - Create a new database and update the database credentials in the `.env` file.
   - Run the database migrations:
     ```bash
     php artisan migrate
     ```

4. **Start the development server:**
   ```bash
   php artisan serve
   ```

5. **Access the application:**
   Open your web browser and visit `http://localhost:8000`.

## Technologies Used

* Laravel
* MySQL
* Bootstrap
* jQuery

## Contributing

Contributions are welcome! Please submit a pull request with your changes.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
