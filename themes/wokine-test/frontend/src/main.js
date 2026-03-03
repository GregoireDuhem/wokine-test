import "./scss/main.scss";
import { initTextReveal } from "./components/TextRevealAnimation";
import { initHeroBgAnimation } from "./components/HeroBgAnimation";
import { initCardAnimation } from "./components/CardAnimation";
import { initProductAnimation } from "./components/ProductAnimation";
import { initButtonHoverAnimation } from "./components/ButtonHoverAnimation";
import { enableDragScroll } from "./components/CardScroll";
import { initProductsArrows } from "./components/ProductsArrows";
console.log("Vite + WordPress OK");

document.addEventListener("DOMContentLoaded", () => {
  enableDragScroll(".products-cards-container");
  initProductsArrows();
  initTextReveal();
  initHeroBgAnimation();
  initCardAnimation();
  initProductAnimation();
  initButtonHoverAnimation();
});
