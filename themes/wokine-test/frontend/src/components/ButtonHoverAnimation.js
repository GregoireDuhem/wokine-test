import { gsap } from "gsap";

export function initButtonHoverAnimation() {
  const buttons = document.querySelectorAll(".animated-button");

  buttons.forEach((btn) => {
    const text = btn.textContent.trim();
    btn.textContent = "";

    const wrapper = document.createElement("span");
    wrapper.className = "animated-button-inner";
    btn.appendChild(wrapper);

    const chars = [];

    Array.from(text).forEach((char, i) => {
      const span = document.createElement("span");
      span.className = "animated-button-char";
      span.textContent = char === " " ? "\u00A0" : char;
      wrapper.appendChild(span);
      chars.push(span);

      gsap.set(span, {
        yPercent: 0,
        textShadow: "0 1.3em",
      });
    });

    const tl = gsap.timeline({ paused: true });

    tl.to(chars, {
      yPercent: -80,
      duration: 0.5,
      ease: "power2.out",
      stagger: 0.01,
    });

    btn.addEventListener("mouseenter", () => tl.play());
    btn.addEventListener("mouseleave", () => tl.reverse());
  });
}
