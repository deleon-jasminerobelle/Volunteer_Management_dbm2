<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Volunteer Registration Form</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background-color: #f5f5f0;
            min-height: 100vh;
            padding: 40px 20px;
        }

        .form-container {
            max-width: 800px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            display: inline-block;
            background-color: #ff6b35;
            padding: 16px;
            border-radius: 16px;
            margin-bottom: 20px;
        }

        .logo svg {
            width: 32px;
            height: 32px;
            color: white;
        }

        h1 {
            color: #111827;
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #6b7280;
            font-size: 16px;
        }

        .form-card {
            background-color: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .section-title {
            font-size: 20px;
            font-weight: 600;
            color: #111827;
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 2px solid #ff6b35;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        label .required {
            color: #ff6b35;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="tel"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.2s;
            outline: none;
            font-family: inherit;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #ff6b35;
            box-shadow: 0 0 0 3px rgba(255, 107, 53, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        select {
            cursor: pointer;
            background-color: white;
        }

        .radio-group,
        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .radio-option,
        .checkbox-option {
            display: flex;
            align-items: center;
        }

        input[type="radio"],
        input[type="checkbox"] {
            width: 18px;
            height: 18px;
            margin-right: 10px;
            cursor: pointer;
            accent-color: #ff6b35;
        }

        .radio-option label,
        .checkbox-option label {
            margin: 0;
            cursor: pointer;
            font-weight: 400;
        }

        .emergency-contact {
            background-color: #fef2f2;
            border: 1px solid #fecaca;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .emergency-contact .section-title {
            color: #991b1b;
            border-bottom-color: #ef4444;
            font-size: 18px;
            margin-bottom: 16px;
        }

        .submit-section {
            margin-top: 32px;
            padding-top: 32px;
            border-top: 1px solid #e5e7eb;
        }

        .submit-btn {
            width: 100%;
            padding: 16px;
            background-color: #ff6b35;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 4px 6px -1px rgba(255, 107, 53, 0.3);
        }

        .submit-btn:hover {
            background-color: #e55a2b;
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(255, 107, 53, 0.4);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }

            .form-card {
                padding: 24px;
            }

            h1 {
                font-size: 24px;
            }
        }

        .helper-text {
            font-size: 12px;
            color: #6b7280;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <div class="header">
            <div class="logo">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                </svg>
            </div>
            <h1>Volunteer Registration</h1>
            <p class="subtitle">Join our community and make a difference</p>
        </div>

        <div class="form-card">
            <form method="POST" action="{{ url('/volunteer-register') }}">
                @csrf

                <!-- Personal Information -->
                <div class="section-title">Personal Information</div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="firstName">First Name <span class="required">*</span></label>
                        <input type="text" id="firstName" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastName">Last Name <span class="required">*</span></label>
                        <input type="text" id="lastName" name="last_name" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="mobile">Mobile Number <span class="required">*</span></label>
                        <input type="tel" id="mobile" name="mobile" placeholder="09XX XXX XXXX" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="facebookName">Facebook Name</label>
                        <input type="text" id="facebookName" name="facebook_name">
                    </div>
                    <div class="form-group">
                        <label for="birthdate">Birthdate <span class="required">*</span></label>
                        <input type="date" id="birthdate" name="birthdate" required>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="address">Complete Address <span class="required">*</span></label>
                    <textarea id="address" name="address" rows="3" required></textarea>
                </div>

                <!-- Education & Experience -->
                <div class="section-title" style="margin-top: 32px;">Education & Experience</div>

                <div class="form-group">
                    <label for="education">Educational Attainment <span class="required">*</span></label>
                    <select id="education" name="education" required>
                        <option value="">Select your highest education</option>
                        <option value="high-school">High School Graduate</option>
                        <option value="vocational">Vocational Course</option>
                        <option value="college-undergrad">College Undergraduate</option>
                        <option value="college-graduate">College Graduate</option>
                        <option value="masters">Master's Degree</option>
                        <option value="doctorate">Doctorate Degree</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="training">Training and Experience</label>
                    <textarea id="training" name="training" rows="4" placeholder="Please list any relevant training, workshops, seminars, or volunteer experience you have..."></textarea>
                </div>

                <div class="form-group">
                    <label for="skills">Skills or Hobbies</label>
                    <textarea id="skills" name="skills" rows="3" placeholder="Share your skills, talents, or hobbies that might be useful in volunteering..."></textarea>
                </div>

                <div class="form-group">
                    <label for="classes">Classes and Training Attended</label>
                    <textarea id="classes" name="classes" rows="3" placeholder="List any specific classes or training programs you've completed..."></textarea>
                </div>

                <!-- Volunteer Preferences -->
                <div class="section-title" style="margin-top: 32px;">Volunteer Preferences</div>

                <div class="form-group">
                    <label>Availability <span class="required">*</span></label>
                    <div class="checkbox-group">
                        <div class="checkbox-option">
                            <input type="checkbox" id="weekdays" name="availability" value="weekdays">
                            <label for="weekdays">Weekdays</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="weekends" name="availability" value="weekends">
                            <label for="weekends">Weekends</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="mornings" name="availability" value="mornings">
                            <label for="mornings">Mornings</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="afternoons" name="availability" value="afternoons">
                            <label for="afternoons">Afternoons</label>
                        </div>
                        <div class="checkbox-option">
                            <input type="checkbox" id="evenings" name="availability" value="evenings">
                            <label for="evenings">Evenings</label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="volunteerArea">Where do you want to volunteer? <span class="required">*</span></label>
                    <select id="volunteerArea" name="volunteer_area" required>
                        <option value="">Select a ministry or area</option>
                        <option value="childrens-ministry">Children's Ministry</option>
                        <option value="youth-ministry">Youth Ministry</option>
                        <option value="worship-team">Worship Team</option>
                        <option value="media-production">Media & Production</option>
                        <option value="hospitality">Hospitality & Ushering</option>
                        <option value="prayer-team">Prayer Team</option>
                        <option value="outreach">Community Outreach</option>
                        <option value="administrative">Administrative Support</option>
                        <option value="facilities">Facilities & Maintenance</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Are you part of a Lifegroup? <span class="required">*</span></label>
                    <div class="radio-group">
                        <div class="radio-option">
                            <input type="radio" id="lifegroupYes" name="lifegroup" value="yes" required>
                            <label for="lifegroupYes">Yes</label>
                        </div>
                        <div class="radio-option">
                            <input type="radio" id="lifegroupNo" name="lifegroup" value="no">
                            <label for="lifegroupNo">No</label>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="emergency-contact">
                    <div class="section-title">Emergency Contact Information</div>
                    
                    <div class="form-row">
                        <div class="form-group">
                            <label for="emergencyName">Contact Name <span class="required">*</span></label>
                            <input type="text" id="emergencyName" name="emergency_name" required>
                        </div>
                        <div class="form-group">
                            <label for="emergencyRelation">Relationship <span class="required">*</span></label>
                            <input type="text" id="emergencyRelation" name="emergency_relation" placeholder="e.g., Spouse, Parent, Sibling" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="emergencyPhone">Contact Number <span class="required">*</span></label>
                            <input type="tel" id="emergencyPhone" name="emergency_phone" placeholder="09XX XXX XXXX" required>
                        </div>
                        <div class="form-group">
                            <label for="emergencyEmail">Email Address</label>
                            <input type="email" id="emergencyEmail" name="emergency_email">
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="submit-section">
                    <button type="submit" class="submit-btn">Submit Registration</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Client-side validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const availabilityChecked = document.querySelectorAll('input[name="availability"]:checked').length;
            if (availabilityChecked === 0) {
                e.preventDefault();
                alert('Please select at least one availability option.');
            }
        });
    </script>
</body>
</html>
