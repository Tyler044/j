<?php
// You can add PHP logic here later (e.g., sessions, database, etc.)
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>LTE Global - Smart Crypto Investments</title>
  <link rel="stylesheet" href="css/index.css">
  <link rel="icon" href="favicon.ico">
</head>
<body>

<header>
  <div class="container header-flex">
    <div class="logo">
      <h1>LTE Global</h1>
    </div>

    <div class="menu-toggle" id="menu-toggle">
      ☰
    </div>

    <nav id="nav">
      <ul>
        <li><a href="#services">Services</a></li>
        <li><a href="#why-us">Why Us</a></li>
        <li><a href="#testimonials">Testimonials</a></li>
        <li><a href="#get-started">Get Started</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>
    </nav>

    <div class="auth-buttons">
      <a href="register.php" class="btn">Register</a>
      <a href="login.php" class="btn">Login</a>
    </div>
  </div>

  <div class="welcome-text">
    <p><marquee>🚀 Welcome to LTE Global – Your Trusted Crypto Investment Platform 🚀</marquee></p>
  </div>
</header>

<section class="hero">
  <div class="container">
    <h2>Smart Crypto Investments. Secure Future.</h2>
    <p>Grow your digital assets with confidence. LTE Global provides secure, transparent, and high-performing cryptocurrency investment solutions designed for both beginners and professionals.</p>
    <a href="#get-started" class="btn btn-primary">Start Investing</a>
  </div>
</section>

<!-- SERVICES -->
<section id="services" class="services">
  <div class="container">
    <h2>Our Investment Services</h2>

    <div class="service-grid">
      <div class="service-card">
        <h3>Crypto Trading</h3>
        <p>Access advanced trading tools and automated strategies to maximize profits in the cryptocurrency market.</p>
      </div>

      <div class="service-card">
        <h3>Portfolio Management</h3>
        <p>Let our experts manage your digital assets with diversified portfolios designed to reduce risk and increase returns.</p>
      </div>

      <div class="service-card">
        <h3>Staking & Passive Income</h3>
        <p>Earn daily returns by staking top cryptocurrencies with our secure and optimized staking system.</p>
      </div>

      <div class="service-card">
        <h3>Secure Wallet Services</h3>
        <p>Your assets are protected with advanced encryption, cold storage, and multi-layer security systems.</p>
      </div>
    </div>

  </div>
</section>

<!-- WHY US -->
<section id="why-us" class="why-us">
  <div class="container">
    <h2>Why Choose LTE Global?</h2>

    <div class="why-grid">
      <div class="why-card">
        <h3>🔒 Top-Level Security</h3>
        <p>We use industry-leading encryption and cold storage technology to keep your funds safe at all times.</p>
      </div>

      <div class="why-card">
        <h3>📈 High Returns</h3>
        <p>Our smart algorithms and expert traders ensure consistent and competitive returns on your investments.</p>
      </div>

      <div class="why-card">
        <h3>⚡ Fast Transactions</h3>
        <p>Enjoy instant deposits and fast withdrawals with minimal fees across all supported cryptocurrencies.</p>
      </div>

      <div class="why-card">
        <h3>🌍 Global Access</h3>
        <p>Trade and invest from anywhere in the world with our easy-to-use platform available 24/7.</p>
      </div>

      <div class="why-card">
        <h3>🤝 Trusted Platform</h3>
        <p>Thousands of investors trust LTE Global for transparency, reliability, and performance.</p>
      </div>

      <div class="why-card">
        <h3>📞 24/7 Support</h3>
        <p>Our dedicated support team is always available to assist you with any inquiries.</p>
      </div>
    </div>

  </div>
</section>

<!-- TESTIMONIALS -->
<section id="testimonials" class="testimonials">
  <div class="container">
    <h2>What Our Investors Say</h2>

    <div class="testimonial-grid">

      <div class="testimonial-card">
        <p>"LTE Global completely changed my financial life. I started small, and now I earn consistent profits weekly."</p>
        <h4>- Daniel O.</h4>
      </div>

      <div class="testimonial-card">
        <p>"The platform is easy to use, and withdrawals are fast. I highly recommend LTE Global to anyone serious about crypto."</p>
        <h4>- Sarah K.</h4>
      </div>

      <div class="testimonial-card">
        <p>"Secure, reliable, and profitable. The best crypto investment platform I’ve used so far."</p>
        <h4>- Michael A.</h4>
      </div>

      <div class="testimonial-card">
        <p>"Their support team is amazing. They helped me every step of the way as a beginner."</p>
        <h4>- Grace T.</h4>
      </div>

    </div>

  </div>
</section>

<section id="get-started" class="get-started">
  <div class="container">
    <h2>Get Started Today</h2>
    <p>Join thousands of investors already growing their wealth with LTE Global.</p>
    <a href="register.php" class="btn btn-primary">Register Now</a>
    <a href="login.php" class="btn">Login to Dashboard</a>
  </div>
</section>

<!-- CONTACT -->
<section id="contact" class="contact">
  <h2>Contact Support</h2>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = htmlspecialchars($_POST['name']);
      $email = htmlspecialchars($_POST['email']);
      $subject = htmlspecialchars($_POST['subject']);
      $message = htmlspecialchars($_POST['message']);

      echo "<p style='color:green;'>Message sent successfully! We will get back to you shortly.</p>";
  }
  ?>

  <form method="POST">
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <input type="text" name="subject" placeholder="Subject" required>
    <textarea name="message" placeholder="Type your message..." required></textarea>
    <button type="submit">Send Message</button>
  </form>
</section>

<footer>
  <div class="container">
    <p>© <?php echo date("Y"); ?> LTE Global. All Rights Reserved.</p>
    <p>Invest responsibly. Cryptocurrency investments carry risk.</p>
  </div>
</footer>

<script>
  const toggle = document.getElementById("menu-toggle");
  const nav = document.getElementById("nav");

  toggle.addEventListener("click", () => {
    nav.classList.toggle("active");
  });
</script>

</body>
</html>