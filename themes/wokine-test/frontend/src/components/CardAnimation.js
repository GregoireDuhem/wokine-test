import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export function initCardAnimation() {
  gsap.fromTo(
    ".card-1, .card-2, .card-3",
    { opacity: 0, scale: 0.5 },
    {
      opacity: 1,
      scale: 1,
      duration: 0.9,
      ease: "power2.inOut",
      stagger: 0.1,
      scrollTrigger: {
        trigger: ".card-1",
        start: "top 80%",
        toggleActions: "play none none reverse",
      },
    }
  );
}
