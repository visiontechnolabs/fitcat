<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>eDemand</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }
    .hero-image {
      background: url('https://edemand.wrteam.me/public/uploads/web_settings/1727435552_acdf7561ec6b35394f6f.jpeg') no-repeat center center;
      background-size: cover;
      min-height: 800px;
      position: relative;
      color: white;
    }
    .overlay {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
    }
    .service-card, .testimonial-card {
      background: #ffffff;
      color: #000;
      border-radius: 15px;
      padding: 20px;
      text-align: center;
      height: 100%;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .testimonial-card small {
      font-weight: 600;
      color: #666;
    }
    .faq-section .accordion-button {
      font-weight: bold;
    }
    .footer {
      background-color: #111;
      color: #fff;
    }
    .footer a {
      color: #ccc;
      text-decoration: none;
    }
    .footer a:hover {
      text-decoration: underline;
    }
    @media (max-width: 768px) {
      .hero-image {
        min-height: 600px;
      }
      .input-group {
        flex-direction: column;
      }
      .input-group input, .input-group button {
        width: 100%;
        margin-bottom: 10px;
      }
    }
  </style>
</head>
<body>
