// ایجاد ذرات ظریف
function createSubtleParticles() {
  const container = document.getElementById("particleContainer");
  const particleCount = 30;

  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement("div");
    particle.classList.add("light-particle");

    particle.style.left = Math.random() * 100 + "%";
    particle.style.animationDelay = Math.random() * 35 + "s";
    particle.style.animationDuration = 35 + Math.random() * 20 + "s";

    container.appendChild(particle);
  }
}

createSubtleParticles();

// نمایش توست حرفه‌ای با انیمیشن بهتر
function showPremiumToast(message, type = "info", duration = 4000) {
  const existingToast = document.querySelector(".premium-toast");
  if (existingToast) {
    existingToast.classList.remove("show");
    setTimeout(() => existingToast.remove(), 500);
  }

  const toast = document.createElement("div");
  toast.classList.add("premium-toast", type);

  const icons = {
    success: "fa-check-circle",
    error: "fa-exclamation-circle",
    info: "fa-info-circle",
  };

  toast.innerHTML = `
    <i class="fas ${icons[type]} toast-icon"></i>
    <span>${message}</span>
  `;

  document.body.appendChild(toast);

  // انیمیشن ورود
  setTimeout(() => {
    toast.classList.add("show");
  }, 100);

  // انیمیشن خروج
  setTimeout(() => {
    toast.classList.remove("show");
    toast.classList.add("hide");
    setTimeout(() => toast.remove(), 500);
  }, duration);
}

// نمایش/مخفی کردن رمز عبور
const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");

togglePassword.addEventListener("click", function () {
  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);

  const icon = this.querySelector("i");
  if (type === "text") {
    icon.classList.remove("fa-eye");
    icon.classList.add("fa-eye-slash");
  } else {
    icon.classList.remove("fa-eye-slash");
    icon.classList.add("fa-eye");
  }
});

// اعتبارسنجی فرم
const inputs = document.querySelectorAll(".premium-input");
inputs.forEach((input) => {
  input.addEventListener("blur", function () {
    if (this.value.trim() === "") {
      this.style.borderColor = "#e74c3c";
      this.style.boxShadow = "0 0 0 3px rgba(231, 76, 60, 0.1)";
    } else {
      this.style.borderColor = "";
      this.style.boxShadow = "";
    }
  });

  input.addEventListener("focus", function () {
    this.style.borderColor = "";
    this.style.boxShadow = "";
  });
});

// افکت parallax برای نورها
document.addEventListener("mousemove", (e) => {
  const mouseX = e.clientX / window.innerWidth - 0.5;
  const mouseY = e.clientY / window.innerHeight - 0.5;

  const glows = document.querySelectorAll(".glow-orb");
  glows.forEach((glow, index) => {
    const speed = (index + 1) * 20;
    const x = mouseX * speed;
    const y = mouseY * speed;
    glow.style.transform = `translate(${x}px, ${y}px)`;
  });
});

// کلیک شبکه‌های اجتماعی
document.querySelectorAll(".social-btn").forEach((btn) => {
  btn.addEventListener("click", function (e) {
    e.preventDefault();
    const platform = this.classList[1];
    const platformNames = {
      google: "گوگل",
      telegram: "تلگرام",
      instagram: "اینستاگرام",
    };
    showPremiumToast(
      `ورود با ${platformNames[platform]} در حال توسعه است`,
      "info",
      4000
    );
  });
});

// لینک فراموشی رمز
document.querySelector(".forgot-link").addEventListener("click", function (e) {
  e.preventDefault();
  showPremiumToast("بازیابی رمز عبور به زودی فعال می‌شود", "info", 4000);
});

// لینک ثبت‌نام
document
  .querySelector(".register-link")
  .addEventListener("click", function (e) {
    e.preventDefault();
    showPremiumToast("صفحه ثبت‌نام در حال ساخت است", "info", 4000);
  });
