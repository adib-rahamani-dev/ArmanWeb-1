// /*  AUTH --> Rejister.php */
// /*  AUTH --> Rejister.php */
// /*  AUTH --> Rejister.php */

// ایجاد ذرات نوری زیاد و ظریف
function createSubtleParticles() {
  const container = document.getElementById("particleContainer");
  const particleCount = 60;

  for (let i = 0; i < particleCount; i++) {
    const particle = document.createElement("div");
    particle.classList.add("light-particle");

    particle.style.left = Math.random() * 100 + "%";
    particle.style.animationDelay = Math.random() * 20 + "s";
    particle.style.animationDuration = 15 + Math.random() * 15 + "s";

    container.appendChild(particle);
  }
}

createSubtleParticles();

// نمایش توست بهبود یافته
function showPremiumToast(message, type = "info", duration = 4000) {
  const existingToast = document.querySelector(".premium-toast");
  if (existingToast) {
    existingToast.classList.remove("show");
    setTimeout(() => existingToast.remove(), 400);
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

  setTimeout(() => toast.classList.add("show"), 100);

  setTimeout(() => {
    toast.classList.remove("show");
    setTimeout(() => toast.remove(), 400);
  }, duration);
}

// مدیریت فرم چندمرحله‌ای با انیمیشن بهتر
const steps = Array.from(document.querySelectorAll(".form-step"));
const nextBtn = document.getElementById("nextBtn");
const prevBtn = document.getElementById("prevBtn");
const submitBtn = document.getElementById("submitBtn");
const stepIndicators = Array.from(document.querySelectorAll(".step"));

let currentStep = 1;
let isTransitioning = false;

function showStep(step) {
  if (isTransitioning) return;
  isTransitioning = true;

  const currentStepElement = document.getElementById(`step${currentStep}`);
  const nextStepElement = document.getElementById(`step${step}`);

  // انیمیشن خروج مرحله فعلی
  currentStepElement.classList.remove("active");
  if (step > currentStep) {
    currentStepElement.classList.add("prev");
  } else {
    currentStepElement.style.transform = "translateX(100px) scale(0.95)";
  }

  // انیمیشن ورود مرحله جدید
  setTimeout(() => {
    currentStepElement.classList.remove("prev");
    currentStepElement.style.transform = "";
    nextStepElement.classList.add("active");

    // به‌روزرسانی نشانگرها با انیمیشن
    stepIndicators.forEach((indicator, index) => {
      const stepNumber = indicator.querySelector(".step-number");

      if (index + 1 < step) {
        indicator.classList.add("completed");
        indicator.classList.remove("active");
        stepNumber.innerHTML = '<i class="fas fa-check"></i>';
      } else if (index + 1 === step) {
        indicator.classList.add("active");
        indicator.classList.remove("completed");
        stepNumber.textContent = step;
      } else {
        indicator.classList.remove("active", "completed");
        stepNumber.textContent = index + 1;
      }
    });

    // نمایش/مخفی کردن دکمه‌ها
    prevBtn.style.display = step === 1 ? "none" : "flex";
    nextBtn.style.display = step === steps.length ? "none" : "flex";
    submitBtn.style.display = step === steps.length ? "flex" : "none";

    currentStep = step;
    isTransitioning = false;
  }, 50);
}

function validateStep(step) {
  let isValid = true;
  const currentStepElement = document.getElementById(`step${step}`);
  const inputs = currentStepElement.querySelectorAll(".premium-input");

  inputs.forEach((input) => {
    if (!input.value.trim()) {
      isValid = false;
      input.style.borderColor = "#e74c3c";
      input.style.boxShadow = "0 0 0 3px rgba(231, 76, 60, 0.1)";
    } else {
      input.style.borderColor = "";
      input.style.boxShadow = "";
    }
  });

  // اعتبارسنجی مرحله ۳
  if (step === 3) {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;
    const termsChecked = document.getElementById("terms").checked;

    if (password !== confirmPassword) {
      isValid = false;
      document.getElementById("confirmPassword").style.borderColor = "#e74c3c";
      showPremiumToast("رمز عبور و تکرار آن یکسان نیستند", "error");
    }

    if (!termsChecked) {
      isValid = false;
      showPremiumToast("لطفاً با قوانین و مقررات موافقت کنید", "error");
    }
  }

  return isValid;
}

nextBtn.addEventListener("click", () => {
  if (validateStep(currentStep)) {
    showStep(currentStep + 1);
  } else {
    showPremiumToast("لطفاً تمام فیلدها را با دقت پر کنید", "error");
  }
});

prevBtn.addEventListener("click", () => {
  showStep(currentStep - 1);
});

// نمایش/مخفی کردن رمز عبور
const togglePassword = document.getElementById("togglePassword");
const passwordInput = document.getElementById("password");

togglePassword.addEventListener("click", function () {
  const type =
    passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);

  const icon = this.querySelector("i");
  icon.classList.toggle("fa-eye");
  icon.classList.toggle("fa-eye-slash");
});

const toggleConfirmPassword = document.getElementById("toggleConfirmPassword");
const confirmPasswordInput = document.getElementById("confirmPassword");

toggleConfirmPassword.addEventListener("click", function () {
  const type =
    confirmPasswordInput.getAttribute("type") === "password"
      ? "text"
      : "password";
  confirmPasswordInput.setAttribute("type", type);

  const icon = this.querySelector("i");
  icon.classList.toggle("fa-eye");
  icon.classList.toggle("fa-eye-slash");
});

// بررسی قدرت رمز عبور
passwordInput.addEventListener("input", function () {
  const password = this.value;
  const strengthMeter = this.parentElement.querySelector(".strength-meter");
  const strengthLabel = this.parentElement.querySelector(".strength-label");
  const strengthContainer = this.parentElement;

  strengthContainer.classList.remove(
    "strength-weak",
    "strength-medium",
    "strength-strong"
  );

  if (password.length === 0) {
    strengthMeter.style.width = "0";
    if (strengthLabel) strengthLabel.textContent = "—";
    return;
  }

  let strength = 0;

  if (password.length >= 8) strength++;
  if (password.length >= 12) strength++;
  if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
  if (/[0-9]/.test(password)) strength++;
  if (/[^a-zA-Z0-9]/.test(password)) strength++;

  if (strength <= 2) {
    strengthContainer.classList.add("strength-weak");
    if (strengthLabel) strengthLabel.textContent = "ضعیف";
  } else if (strength <= 4) {
    strengthContainer.classList.add("strength-medium");
    if (strengthLabel) strengthLabel.textContent = "متوسط";
  } else {
    strengthContainer.classList.add("strength-strong");
    if (strengthLabel) strengthLabel.textContent = "قوی";
  }
});

// مدیریت مودال قوانین و مقررات
const termsModal = document.getElementById("termsModal");
const termsLink = document.getElementById("termsLink");
const modalClose = document.getElementById("modalClose");

termsLink.addEventListener("click", function (e) {
  e.preventDefault();
  termsModal.classList.add("active");
});

modalClose.addEventListener("click", function () {
  termsModal.classList.remove("active");
});

termsModal.addEventListener("click", function (e) {
  if (e.target === termsModal) {
    termsModal.classList.remove("active");
  }
});

// ارسال فرم
document
  .getElementById("registerForm")
  .addEventListener("submit", function (e) {
    e.preventDefault();

    if (!validateStep(currentStep)) {
      showPremiumToast("لطفاً تمام فیلدها را با دقت پر کنید", "error");
      return;
    }

    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML =
      '<i class="fas fa-spinner fa-spin"></i> در حال ثبت‌نام...';
    submitBtn.disabled = true;

    setTimeout(() => {
      submitBtn.innerHTML = '<i class="fas fa-check"></i> ثبت‌نام موفق';
      submitBtn.classList.add("success");
      showPremiumToast("ثبت‌نام با موفقیت انجام شد!", "success");

      setTimeout(() => {
        submitBtn.classList.remove("success");
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
      }, 2000);
    }, 2000);
  });

// شبکه‌های اجتماعی
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
      `ثبت‌نام با ${platformNames[platform]} در حال توسعه است`,
      "info"
    );
  });
});

// لینک ورود
document.querySelector(".login-link").addEventListener("click", function (e) {
  e.preventDefault();
  showPremiumToast("در حال انتقال به صفحه ورود...", "info");
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

// /*  AUTH --> login.php */
// /*  AUTH --> login.php */
// /*  AUTH --> login.php */

