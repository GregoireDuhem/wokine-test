import { gsap } from "gsap";

export function initUnderlineAnimation() {
  const triggers = document.querySelectorAll(".card-1-button, .card-2-button, .card-3-button");

  triggers.forEach((el) => {
    const underline = el.querySelector(".underline");
    if (!underline) return;

    gsap.set(underline, { transformOrigin: "right center" });

    const tl = gsap.timeline({ paused: true });

    tl.to(underline, {
      scaleX: 0,
      duration: 0.4,
      ease: "power2.in",
    });
    tl.set(underline, { transformOrigin: "left center" });
    tl.to(underline, {
      scaleX: 1,
      duration: 0.25,
      ease: "power2.out",
    });
    tl.set(underline, { transformOrigin: "right center" });

    el.addEventListener("mouseenter", () => tl.restart());
  });
}
