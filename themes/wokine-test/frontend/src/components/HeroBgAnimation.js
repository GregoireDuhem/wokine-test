import { gsap } from "gsap";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

export function initHeroBgAnimation() {
  gsap.fromTo(
    ".hero-image-container",
    { opacity: 0.5, scale: 0.7 },
    {
      opacity: 1,
      scale: 1,
      duration: 0.9,
      ease: "power2.out",
    }
  );
}
