# Date Picker Component

## Usage

The date picker component is a reusable Blade component that can be used anywhere in your application.

### Basic Usage

```blade
<x-date-picker label="Select Date" name="my_date" />
```

### With Required Field

```blade
<x-date-picker label="Birth Date" name="birth_date" required />
```

### Props

- **label** (string, required): The label text displayed above the date picker
- **name** (string, required): The form field name for the hidden input
- **required** (boolean, optional, default: false): Whether the field is required

### JavaScript File

The component relies on `public/js/date-picker.js` which contains the Alpine.js logic. Make sure to include it in your view:

```blade
<script src="{{ asset('js/date-picker.js') }}"></script>
```

### Features

- Calendar dropdown with month navigation
- "Today" quick select button
- Dark mode support
- Responsive design
- DD/MM/YYYY format display
- YYYY-MM-DD format for form submission
- Click outside to close

### Example in a Form

```blade
<form action="/submit" method="POST">
    @csrf
    <x-date-picker label="Start Date" name="start_date" required />
    <x-date-picker label="End Date" name="end_date" required />
    <button type="submit">Submit</button>
</form>
```
