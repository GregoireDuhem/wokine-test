import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export function initProductAnimation() {
  gsap.fromTo(
    ".products-card",
    { opacity: 0, x: 150 },
    {
      opacity: 1,
      scale: 1,
      x: 0,
      duration: 0.9,
      ease: "power2.out",
      stagger: 0.15,
      scrollTrigger: {
        trigger: ".products-card",
        start: "top 80%",
        toggleActions: "play none none reverse",
      },
    }
  );
}
