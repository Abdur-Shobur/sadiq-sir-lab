# Team Image Crop Feature

## Overview

Added image cropping functionality to the team create and edit forms using Cropper.js library.

## Features Added

### 1. Image Preview

-   When a user selects an image file, it shows a preview
-   Preview displays the selected image with crop and remove options

### 2. Image Cropping

-   **Crop Button**: Opens a modal with Cropper.js interface
-   **Aspect Ratio**: Fixed to 1:1 (square) for profile images
-   **Crop Area**: Automatically sets to 80% of the image
-   **Output Size**: Crops to 300x300 pixels (minimum 256x256, maximum 1024x1024)

### 3. Edit Form Enhancements

-   **Current Image Display**: Shows existing team member image
-   **Crop Current Image**: Allows cropping of existing images
-   **New Image Upload**: Standard file upload with crop functionality

## Technical Implementation

### Files Modified

1. `resources/views/dashboard/teams/create.blade.php`
2. `resources/views/dashboard/teams/edit.blade.php`
3. `resources/views/team/dashboard/profile.blade.php`
4. `resources/views/dashboard/profile/edit.blade.php`

### Dependencies Added

-   Cropper.js library (via CDN)
-   Custom CSS for modal styling

### JavaScript Functions

-   `previewImage()`: Shows image preview when file is selected
-   `openCropModal()`: Opens cropping interface
-   `cropImage()`: Processes cropped image and updates form
-   `removeImage()`: Removes selected image
-   `cropCurrentImage()`: Crops existing team member image (edit form only)

## Usage Instructions

### Creating New Team Member

1. Fill in team member details
2. Click "Choose File" to select an image
3. Image preview will appear with "Crop Image" and "Remove" buttons
4. Click "Crop Image" to open cropping interface
5. Adjust crop area as needed
6. Click "Crop & Save" to apply changes
7. Submit the form

### Editing Existing Team Member

1. Navigate to team member edit page
2. Current image is displayed with "Crop Current Image" button
3. To crop existing image: Click "Crop Current Image"
4. To upload new image: Select new file and follow cropping process
5. Submit the form

### Team Profile Page (http://localhost:8001/team-profile)

1. Navigate to team profile page
2. Current profile image is displayed with "Crop Current Image" button
3. To crop existing image: Click "Crop Current Image"
4. To upload new image: Select new file and follow cropping process
5. Submit the form

### Dashboard Profile Page (http://127.0.0.1:8001/dashboard/profile)

1. Navigate to dashboard profile page
2. Current profile image is displayed with "Crop Current Image" button
3. To crop existing image: Click "Crop Current Image"
4. To upload new image: Select new file and follow cropping process
5. Submit the form

## Browser Compatibility

-   Modern browsers with Canvas API support
-   File API support required
-   JavaScript must be enabled

## File Size Limits

-   Maximum file size: 2MB (as per existing validation)
-   Supported formats: JPEG, PNG, JPG, GIF
-   Output format: JPEG (90% quality)

## Notes

-   Cropped images are automatically optimized for web display
-   Original file validation rules remain unchanged
-   No server-side changes required - works with existing TeamController
