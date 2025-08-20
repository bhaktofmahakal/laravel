# Recycling Facility Directory

A Laravel application for managing a directory of recycling facilities with their accepted materials, built with MySQL database.

## Features

- **CRUD Operations**: Add, edit, view, and delete recycling facilities
- **Search Functionality**: Search facilities by name, city, or accepted materials
- **Material Filtering**: Filter facilities by specific materials they accept
- **Sorting**: Sort facilities by last update date (newest first)
- **CSV Export**: Download filtered results as CSV file
- **Google Maps Integration**: View facility locations on embedded maps
- **Responsive Design**: Bootstrap-based UI that works on all devices
- **Data Validation**: Form validation for all required fields

## Database Design and Relationships

### Tables Structure

1. **facilities**
   - `id` (Primary Key)
   - `business_name` (String) - Name of the recycling facility
   - `last_update_date` (Date) - When the facility information was last updated
   - `street_address` (String) - Street address of the facility
   - `city` (String) - City where the facility is located
   - `created_at`, `updated_at` (Timestamps)

2. **materials**
   - `id` (Primary Key)
   - `name` (String) - Name of the recyclable material
   - `created_at`, `updated_at` (Timestamps)

3. **facility_material** (Pivot Table)
   - `id` (Primary Key)
   - `facility_id` (Foreign Key to facilities.id)
   - `material_id` (Foreign Key to materials.id)
   - `created_at`, `updated_at` (Timestamps)

### Relationships

- **Facilities ↔ Materials**: Many-to-Many relationship
  - A facility can accept multiple materials
  - A material can be accepted by multiple facilities
  - Implemented using Laravel's `belongsToMany()` relationship

## Implementation Details

### Search, Filter, Sort, and Export

1. **Search Implementation**:
   - Uses Laravel's query builder with `LIKE` operators
   - Searches across facility name, city, and related materials
   - Implemented using `whereHas()` for material relationships

2. **Filter Implementation**:
   - Dropdown filter for materials using `whereHas()` relationship queries
   - Maintains search parameters in URL for bookmarking

3. **Sort Implementation**:
   - Default sorting by `last_update_date` in descending order
   - Uses Laravel's `orderBy()` method

4. **Export Implementation**:
   - CSV export using Laravel's Response streaming
   - Exports currently filtered/searched results
   - Includes all facility details and concatenated materials

### Key Features Implementation

- **Pagination**: Laravel's built-in pagination with 10 items per page
- **Validation**: Server-side validation using Laravel's form requests
- **Google Maps**: JavaScript integration with Google Maps API for location display
- **Responsive UI**: Bootstrap 5 for mobile-friendly interface

## Installation and Setup

### Prerequisites
- PHP 8.1 or higher
- Composer
- MySQL
- XAMPP (or similar local server environment)

### Installation Steps

1. **Clone/Download the project**
   ```bash
   # Project is already set up in current directory
   ```

2. **Install Dependencies**
   ```bash
   composer install
   ```

3. **Environment Configuration**
   ```bash
   # Copy .env.example to .env (already done)
   # Update database configuration in .env:
   DB_DATABASE=recycling_facility_directory
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Create Database**
   ```bash
   # Create MySQL database named 'recycling_facility_directory'
   mysql -u root -e "CREATE DATABASE recycling_facility_directory;"
   ```

6. **Run Migrations and Seeders**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Start Development Server**
   ```bash
   php artisan serve
   ```

8. **Access Application**
   - Open browser and navigate to `http://localhost:8000`

## Usage

### Adding a New Facility
1. Click "Add New Facility" button
2. Fill in all required fields:
   - Business Name
   - Last Update Date
   - Street Address
   - City
   - Select at least one material
3. Click "Create Facility"

### Searching and Filtering
1. Use the search bar to find facilities by name, city, or material
2. Use the material dropdown to filter by specific materials
3. Click "Export CSV" to download current results

### Viewing Facility Details
1. Click the eye icon in the actions column
2. View complete facility information
3. See location on embedded Google Map (requires API key)

## Sample Data

The application includes sample data with 5 recycling facilities:
- Green Earth Recyclers (New York)
- EcoTech Solutions (Los Angeles)
- Sustainable Waste Management (Chicago)
- Metro Recycling Center (Houston)
- Digital Waste Processors (Phoenix)

## Extra Features Added

1. **Enhanced UI/UX**:
   - Professional Bootstrap design
   - Font Awesome icons
   - Color-coded badges for materials
   - Responsive layout

2. **Advanced Search**:
   - Multi-field search capability
   - Real-time filtering
   - URL parameter preservation

3. **Google Maps Integration**:
   - Embedded maps on facility detail pages
   - Automatic geocoding of addresses

4. **Data Export**:
   - CSV export with proper formatting
   - Timestamped filenames

5. **Form Validation**:
   - Client and server-side validation
   - User-friendly error messages

## Technical Stack

- **Backend**: Laravel 10.x
- **Database**: MySQL
- **Frontend**: Bootstrap 5, Font Awesome
- **Maps**: Google Maps JavaScript API
- **Server**: PHP built-in development server

## File Structure

```
├── app/
│   ├── Http/Controllers/FacilityController.php
│   └── Models/
│       ├── Facility.php
│       └── Material.php
├── database/
│   ├── migrations/
│   └── seeders/
├── resources/views/
│   ├── layouts/app.blade.php
│   └── facilities/
│       ├── index.blade.php
│       ├── create.blade.php
│       ├── show.blade.php
│       └── edit.blade.php
└── routes/web.php
```

## Future Enhancements

- User authentication system
- Admin panel for material management
- Advanced reporting features
- API endpoints for mobile app integration
- Email notifications for facility updates