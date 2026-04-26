<style>
    :root {
        --accent: #00d2ff;
        --accent-dark: #3a7bd5;
        --dark: #1e272e;
        --glass: rgba(255, 255, 255, 0.5);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    body {
        background: #eef2f3;
        min-height: 100vh;
        overflow-x: hidden;
        color: var(--dark);
        position: relative;
    }

    .background-blobs {
        position: fixed;
        width: 100vw;
        height: 100vh;
        z-index: -1;
        top: 0;
        left: 0;
    }

    .animated-bg {
        position: fixed;
        width: 100vw;
        height: 100vh;
        top: 0;
        left: 0;
        z-index: -2;
        pointer-events: none;
    }

    .blob {
        position: absolute;
        filter: blur(60px);
        border-radius: 50%;
        animation: float 15s infinite alternate ease-in-out;
    }

    .blob-1 {
        width: 400px;
        height: 400px;
        background: var(--accent);
        top: -10%;
        right: -5%;
    }

    .blob-2 {
        width: 450px;
        height: 450px;
        background: var(--accent-dark);
        bottom: -10%;
        left: -5%;
    }

    @keyframes float {
        0% { transform: translate(0, 0); }
        100% { transform: translate(-30px, 30px); }
    }

    .shape {
        position: absolute;
        background: rgba(58, 123, 213, 0.1);
        z-index: -2;
    }

    .circle {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        top: 20%;
        left: 10%;
    }

    .triangle {
        width: 0;
        height: 0;
        border-left: 50px solid transparent;
        border-right: 50px solid transparent;
        border-bottom: 80px solid rgba(0, 210, 255, 0.1);
        top: 70%;
        left: 80%;
        background: transparent;
    }

    .square {
        width: 90px;
        height: 90px;
        top: 18%;
        right: 12%;
        border-radius: 18px;
        transform: rotate(20deg);
        background: rgba(58, 123, 213, 0.08);
    }

    nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 30px 8%;
        position: fixed;
        width: 100%;
        top: 0;
        left: 0;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        z-index: 200;
    }

    .logo {
        font-size: 1.6rem;
        font-weight: 800;
    }

    .logo span {
        color: var(--accent-dark);
    }

    .nav-links {
        display: flex;
        gap: 15px;
        align-items: center;
        flex-wrap: wrap;
    }

    .btn-login {
        background: var(--dark);
        color: white;
        text-decoration: none;
        padding: 12px 25px;
        border-radius: 50px;
        font-weight: 600;
        white-space: nowrap;
        transition: 0.3s;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-login:hover {
        background: var(--accent-dark);
        transform: translateY(-2px);
    }

    .btn-signup {
        background: var(--accent-dark);
        color: white;
    }

    .logout-form {
        display: inline;
    }

    .hero {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 140px 8% 40px 8%;
        gap: 50px;
        min-height: 80vh;
    }

    .hero-text {
        flex: 1;
    }

    .hero-text h1 {
        font-size: 3.8rem;
        line-height: 1.1;
        margin-bottom: 20px;
    }

    .hero-text h1 span {
        background: linear-gradient(90deg, var(--accent), var(--accent-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hero-text p {
        font-size: 1.1rem;
        color: #4b5563;
        margin-bottom: 18px;
        line-height: 1.6;
        max-width: 650px;
    }

    .hero-visual {
        flex: 0 0 auto;
    }

    .welcome-badge {
        display: inline-block;
        margin-bottom: 24px;
        padding: 10px 18px;
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 999px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        font-weight: 600;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 10px;
        background: white;
        padding: 8px 10px;
        border-radius: 15px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        width: 100%;
        max-width: 500px;
        position: relative;
    }

    .search-box input {
        flex: 1;
        border: none;
        outline: none;
        padding: 12px 15px;
        font-size: 1rem;
        border-radius: 10px;
        background: transparent;
    }

    .search-box button {
        padding: 12px 20px;
        border: none;
        background: var(--accent-dark);
        color: white;
        font-weight: 600;
        border-radius: 10px;
        cursor: pointer;
        transition: 0.3s;
    }

    .search-box button:hover {
        background: var(--accent);
    }

    .autocomplete-items {
        position: absolute;
        border: 1px solid #ddd;
        max-height: 150px;
        overflow-y: auto;
        background-color: #fff;
        width: 100%;
        border-radius: 0 0 10px 10px;
        z-index: 150;
    }

    .autocomplete-items div {
        padding: 10px;
        cursor: pointer;
    }

    .autocomplete-items div:hover {
        background-color: #e9e9e9;
    }

    #results {
        margin-top: 10px;
        max-height: 250px;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 500px;
    }

    .doctor-card {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 12px;
        background-color: #fff;
        cursor: pointer;
        transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
    }

    .doctor-card:hover {
        transform: scale(1.02);
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
        border-color: var(--accent-dark);
    }

    .doctor-photo-container {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
        background: #fff;
    }

    .doctor-photo {
        max-width: 100%;
        max-height: 100%;
        object-fit: cover;
    }

    .card {
        background: var(--glass);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.6);
        width: 350px;
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
        transition: transform 0.1s ease-out;
    }

    .video-wrapper {
        width: 100%;
        height: 350px;
        background: #000;
    }

    .doc-vid {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
    }

    .card-action {
        padding: 25px;
    }

    .confirm-btn {
        width: 100%;
        padding: 18px;
        border-radius: 20px;
        border: none;
        background: var(--dark);
        color: white;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
    }

    .back-home {
    text-align: center;
    margin-top: 25px;
}

.back-home a {
    text-decoration: none;
    color: #3a7bd5;
    font-weight: 600;
    font-size: 0.95rem;
    transition: 0.2s;
}

.back-home a:hover {
    color: #00d2ff;
    transform: translateX(-3px);
}

    .confirm-btn:hover {
        background: #000;
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    }

    .reveal {
        animation: fadeIn 0.8s ease-out forwards;
    }

    .reveal-delay {
        animation: fadeIn 1s ease-out forwards;
        opacity: 0;
        animation-delay: 0.2s;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .login-container {
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
        padding: 20px;
        z-index: 2;
        position: relative;
    }

    .login-card {
        background: white;
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
        text-align: center;
    }

    .login-card h2 {
        margin-bottom: 10px;
        font-weight: 700;
        color: var(--dark);
    }

    .login-card h2 span {
        color: var(--accent-dark);
    }

    .tabs {
        display: flex;
        justify-content: space-around;
        margin-bottom: 25px;
        border-bottom: 2px solid #f1f1f1;
    }

    .tab {
        padding: 10px 0;
        flex-grow: 1;
        cursor: pointer;
        font-weight: 600;
        color: #888;
        text-decoration: none;
    }

    .tab.active {
        color: var(--dark);
        border-bottom: 2px solid var(--accent-dark);
    }

    .social-btn {
        width: 100%;
        padding: 12px;
        margin-bottom: 12px;
        border-radius: 12px;
        border: 1px solid #ddd;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        background: white;
        color: #555;
        transition: 0.3s;
    }

    .social-btn:hover {
        background-color: #f8f9fa;
    }

    .separator {
        margin: 20px 0;
        color: #888;
        position: relative;
        font-size: 0.8rem;
    }

    .separator::before,
    .separator::after {
        content: "";
        position: absolute;
        top: 50%;
        width: 40%;
        height: 1px;
        background: #eee;
    }

    .separator::before {
        left: 0;
    }

    .separator::after {
        right: 0;
    }

    .form-group {
        text-align: left;
        margin-bottom: 15px;
    }

    .form-group input {
        width: 100%;
        padding: 14px;
        border: 1px solid #eee;
        border-radius: 12px;
        background: #f9f9f9;
        outline: none;
        box-sizing: border-box;
        font-size: 14px;
    }

    .btn-submit {
        width: 100%;
        padding: 16px;
        background: var(--accent-dark);
        color: white;
        border: none;
        border-radius: 12px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
    }

    .btn-submit:hover {
        opacity: 0.95;
        transform: translateY(-1px);
    }

    .remember-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin: 12px 0 18px 0;
        gap: 10px;
        flex-wrap: wrap;
    }

    .remember-label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 14px;
        color: #555;
    }

    .forgot-link {
        font-size: 14px;
        color: var(--accent-dark);
        text-decoration: none;
        font-weight: 600;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

    .error-text {
        color: #dc2626;
        font-size: 13px;
        margin-top: 6px;
    }

    .status-text {
        background: #ecfdf5;
        color: #065f46;
        border: 1px solid #a7f3d0;
        padding: 12px;
        border-radius: 12px;
        margin-bottom: 16px;
        font-size: 14px;
        text-align: left;
    }

    .bottom-link {
        margin-top: 18px;
        font-size: 14px;
        color: #666;
    }

    .bottom-link a {
        color: var(--accent-dark);
        text-decoration: none;
        font-weight: 600;
    }

    .bottom-link a:hover {
        text-decoration: underline;
    }

    .profile-page {
        padding: 140px 8% 50px 8%;
        min-height: 100vh;
    }

    .page-title {
        font-size: 2.5rem;
        margin-bottom: 10px;
        font-weight: 700;
    }

    .page-title span {
        background: linear-gradient(90deg, var(--accent), var(--accent-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .page-subtitle {
        color: #4b5563;
        margin-bottom: 30px;
        line-height: 1.6;
        max-width: 700px;
    }

    .profile-grid {
        display: flex;
        flex-direction: column;
        gap: 24px;
        max-width: 1100px;
    }

    .profile-card {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(255, 255, 255, 0.7);
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        padding: 28px;
    }

    .profile-card h3 {
        font-size: 1.3rem;
        margin-bottom: 8px;
        color: var(--dark);
    }

    .profile-card p {
        color: #6b7280;
        margin-bottom: 20px;
        line-height: 1.5;
    }

    .section-wrapper {
        max-width: 800px;
    }

    .profile-card input[type="text"],
    .profile-card input[type="email"],
    .profile-card input[type="password"],
    .profile-card textarea,
    .profile-card select {
        width: 100%;
        padding: 14px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #f9f9f9;
        outline: none;
        box-sizing: border-box;
        font-size: 14px;
    }

    .profile-card input:focus,
    .profile-card textarea:focus,
    .profile-card select:focus {
        border-color: var(--accent-dark);
        box-shadow: 0 0 0 3px rgba(58, 123, 213, 0.12);
    }

    .profile-card label {
        display: inline-block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--dark);
    }

    .profile-card button,
    .profile-card [type="submit"] {
        background: var(--accent-dark);
        color: white;
        border: none;
        padding: 12px 22px;
        border-radius: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: 0.3s;
    }

    .profile-card button:hover,
    .profile-card [type="submit"]:hover {
        transform: translateY(-2px);
        opacity: 0.96;
    }

    .danger-zone button,
    .danger-zone [type="submit"] {
        background: #dc2626;
    }

    .danger-zone button:hover,
    .danger-zone [type="submit"]:hover {
        background: #b91c1c;
    }

    .profile-card .text-gray-600,
    .profile-card .text-gray-700,
    .profile-card .text-gray-800,
    .profile-card .text-sm {
        color: #4b5563 !important;
    }

    .profile-card .text-red-600 {
        color: #dc2626 !important;
    }

    .profile-card .max-w-xl,
    .profile-card .max-w-lg,
    .profile-card .max-w-md {
        max-width: 100% !important;
    }

    .profile-card .mt-6 { margin-top: 1.5rem !important; }
    .profile-card .mt-4 { margin-top: 1rem !important; }
    .profile-card .mt-2 { margin-top: 0.5rem !important; }
    .profile-card .mb-4 { margin-bottom: 1rem !important; }
    .profile-card .space-y-6 > * + * { margin-top: 1.5rem !important; }
    .profile-card .space-y-4 > * + * { margin-top: 1rem !important; }

    .doctor-page {
        padding: 140px 8% 50px 8%;
    }

    .doctor-buttons {
        display: flex;
        gap: 15px;
        margin-top: 15px;
    }

    .calendar-page {
        padding: 40px;
        font-family: 'Poppins', sans-serif;
        text-align: center;
    }

    .calendar-container {
        width: 350px;
        margin: auto;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .calendar-header button {
        background: #00d2ff;
        border: none;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .calendar-days {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        font-weight: 600;
        margin-bottom: 10px;
    }

    .calendar-dates {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
    }

    .calendar-dates div {
        padding: 10px;
        cursor: pointer;
        border-radius: 6px;
    }

    .calendar-dates div:hover {
        background: #e3f7ff;
    }

    .selected {
        background: #00d2ff;
        color: white;
    }

    .time-slots {
        margin-top: 30px;
    }

    #slots {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
        margin-top: 10px;
    }

    .slot {
        background: #3a7bd5;
        color: white;
        padding: 8px 12px;
        border-radius: 6px;
        cursor: pointer;
    }

    .slot:hover {
        background: #2a5db0;
    }

    .doctor-header {
        display: flex;
        gap: 40px;
        align-items: center;
        flex-wrap: wrap;
    }

    .doctor-info h1 {
        font-size: 2.5rem;
        margin-bottom: 10px;
    }

    .doctor-info h3 {
        font-size: 1.2rem;
        margin-bottom: 20px;
        color: var(--accent-dark);
    }

    .doctor-info p {
        margin-bottom: 15px;
        line-height: 1.5;
    }

    .doctor-details {
        margin-top: 40px;
    }

    .doctor-details h2 {
        color: var(--accent-dark);
        margin-bottom: 10px;
    }

    @media (max-width: 992px) {
        .hero {
            flex-direction: column;
            text-align: center;
            padding-top: 160px;
        }

        .search-box,
        #results {
            margin-left: auto;
            margin-right: auto;
        }

        .hero-text h1 {
            font-size: 2.8rem;
        }
    }

    @media (max-width: 768px) {
        .profile-page {
            padding: 170px 5% 30px 5%;
        }

        .page-title {
            font-size: 2rem;
        }

        .profile-card {
            padding: 20px;
        }
    }

    @media (max-width: 600px) {
        nav {
            padding: 20px 5%;
            flex-direction: column;
            gap: 15px;
        }

        .hero {
            padding: 170px 5% 30px 5%;
        }

        .hero-text h1 {
            font-size: 2.2rem;
        }

        .card {
            width: 100%;
            max-width: 350px;
        }

        .nav-links {
            justify-content: center;
        }
    }
   
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 14px;
        border: 1px solid #eee;
        border-radius: 12px;
        background: #f9f9f9;
        outline: none;
        box-sizing: border-box;
        font-size: 14px;
        color: var(--dark);
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: var(--accent-dark);
        box-shadow: 0 0 0 3px rgba(58, 123, 213, 0.12);
    }

    .hidden-block {
        display: none;
    }

    .register-card {
        max-width: 520px;
    }

    .dashboard-page {
        padding: 140px 8% 50px 8%;
        min-height: 100vh;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
        gap: 20px;
        margin-top: 30px;
    }

    .dashboard-card {
        background: rgba(255, 255, 255, 0.88);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(255, 255, 255, 0.7);
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
        padding: 24px;
    }

    .dashboard-card h3 {
        font-size: 1.2rem;
        margin-bottom: 10px;
        color: var(--dark);
    }

    .dashboard-card p {
        color: #6b7280;
        line-height: 1.5;
        margin-bottom: 16px;
    }

    .dashboard-stat {
        font-size: 2rem;
        font-weight: 700;
        color: var(--accent-dark);
    }

    .dashboard-actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 15px;
    }

    .dashboard-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        padding: 12px 18px;
        border-radius: 14px;
        font-weight: 600;
        background: var(--accent-dark);
        color: white;
        transition: 0.3s;
        border: none;
        cursor: pointer;
    }

    .dashboard-btn:hover {
        transform: translateY(-2px);
        opacity: 0.96;
    }

    .dashboard-btn.secondary {
        background: white;
        color: var(--dark);
        border: 1px solid #e5e7eb;
    }

    .list-card {
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(255, 255, 255, 0.7);
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.06);
        margin-bottom: 18px;
    }

    .list-card p {
        margin-bottom: 8px;
        color: #4b5563;
    }

    .list-card strong {
        color: var(--dark);
    }

    .section-title {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .section-title span {
        background: linear-gradient(90deg, var(--accent), var(--accent-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .section-subtitle {
        color: #6b7280;
        margin-bottom: 25px;
        max-width: 800px;
        line-height: 1.6;
    }
    /* Dashboard container */
.dashboard-page{
    max-width:1200px;
    margin:120px auto 60px;
    padding:40px;
    background:white;
    border-radius:18px;
    box-shadow:0 15px 40px rgba(0,0,0,0.08);
}

/* Section title */
.section-title{
    font-size:28px;
    font-weight:700;
    margin-bottom:30px;
    color:#1f2937;
}

/* Table */
.appointments-table{
    width:100%;
    border-collapse:collapse;
    border-radius:12px;
    overflow:hidden;
}

/* Table header */
.appointments-table thead{
    background:#2563eb;
    color:white;
}

.appointments-table th{
    text-align:left;
    padding:16px;
    font-size:14px;
    letter-spacing:0.5px;
}

/* Table rows */
.appointments-table td{
    padding:16px;
    border-bottom:1px solid #f1f1f1;
    font-size:14px;
    color:#374151;
}

/* Zebra effect */
.appointments-table tbody tr:nth-child(even){
    background:#f9fafb;
}

.appointments-table tbody tr:hover{
    background:#eef2ff;
    transition:0.2s;
}

/* Status badges */
.status-pending{
    background:#fef3c7;
    color:#92400e;
    padding:6px 10px;
    border-radius:8px;
    font-size:12px;
    font-weight:600;
}

.status-confirmed{
    background:#dcfce7;
    color:#166534;
    padding:6px 10px;
    border-radius:8px;
    font-size:12px;
    font-weight:600;
}

.status-rejected{
    background:#fee2e2;
    color:#991b1b;
    padding:6px 10px;
    border-radius:8px;
    font-size:12px;
    font-weight:600;
}

/* Buttons */
.appointments-table button{
    border:none;
    padding:8px 14px;
    border-radius:8px;
    font-size:13px;
    font-weight:600;
    cursor:pointer;
    transition:0.2s;
}

/* Confirm button */
.appointments-table form:first-child button{
    background:#10b981;
    color:white;
    margin-right:6px;
}

.appointments-table form:first-child button:hover{
    background:#059669;
}

/* Reject button */
.appointments-table form:last-child button{
    background:#ef4444;
    color:white;
}

.appointments-table form:last-child button:hover{
    background:#dc2626;
}

    @media (max-width: 768px) {
        .dashboard-page {
            padding: 170px 5% 30px 5%;
        }

        .section-title {
            font-size: 1.9rem;
        }
    }
.availability-form{
display:flex;
gap:15px;
margin-top:20px;
flex-wrap:wrap;
}

.availability-slot{
display:flex;
justify-content:space-between;
align-items:center;
background:white;
padding:15px;
border-radius:10px;
margin-top:10px;
box-shadow:0 4px 10px rgba(0,0,0,0.05);
}
</style>
