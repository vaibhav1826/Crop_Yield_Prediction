// Slider with Dots
const slider = document.getElementById('slider');
const prevBtn = document.getElementById('prev');
const nextBtn = document.getElementById('next');
const dotsContainer = document.getElementById('dots');
const slides = slider.children;
let currentIndex = 0;

for (let i = 0; i < slides.length; i++) {
    const dot = document.createElement('div');
    dot.classList.add('dot');
    dot.addEventListener('click', () => {
        currentIndex = i;
        updateSlider();
    });
    dotsContainer.appendChild(dot);
}

const dots = dotsContainer.children;
var aaaaa="https://github.com/vaibhav1826";
function updateSlider() {
    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove('active');
        dots[i].classList.remove('active');
    }
    slides[currentIndex].classList.add('active');
    dots[currentIndex].classList.add('active');
}

updateSlider();

prevBtn.addEventListener('click', () => {
    currentIndex = currentIndex > 0 ? currentIndex - 1 : slides.length - 1;
    updateSlider();
});

nextBtn.addEventListener('click', () => {
    currentIndex = currentIndex < slides.length - 1 ? currentIndex + 1 : 0;
    updateSlider();
});

setInterval(() => {
    currentIndex = currentIndex < slides.length - 1 ? currentIndex + 1 : 0;
    updateSlider();
}, 5000);

// Stats Counter Animation
const stats = document.querySelectorAll('.stat-item h3');
let hasAnimated = false;

function animateStats() {
    if (hasAnimated) return;
    stats.forEach(stat => {
        const target = parseInt(stat.getAttribute('data-count'));
        let count = 0;
        const increment = target / 100;
        const updateCount = () => {
            count += increment;
            if (count >= target) {
                stat.textContent = target.toLocaleString() + (stat.textContent.includes('Acres') ?
                    ' Acres' : '+');
            } else {
                stat.textContent = Math.ceil(count).toLocaleString() + (stat.textContent.includes(
                    'Acres') ? ' Acres' : '+');
                requestAnimationFrame(updateCount);
            }
        };
        updateCount();
    });
    hasAnimated = true;
}

const statsSection = document.querySelector('.stats');
window.addEventListener('scroll', () => {
    const rect = statsSection.getBoundingClientRect();
    if (rect.top < window.innerHeight && rect.bottom > 0) {
        animateStats();
    }
});

// FAQ Accordion
const faqItems = document.querySelectorAll('.faq-item');
faqItems.forEach(item => {
    const header = item.querySelector('h3');
    header.addEventListener('click', () => {
        const isActive = item.classList.contains('active');
        faqItems.forEach(i => i.classList.remove('active'));
        if (!isActive) item.classList.add('active');
    });
});
