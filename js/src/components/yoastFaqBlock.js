export default class YoastFaqBlock {

    constructor() {
        // ----- TO DO -----
        // Test this solution and move inside Javascript Class: Soluzione basata sul blocco FAQ di Yoast SEO.
        const faqSingleTriggers = document.querySelectorAll('.schema-faq-question');
        faqSingleTriggers.forEach((trigger) => trigger.addEventListener('click', toggleAccordion));
        function toggleAccordion() {
            const items = document.querySelectorAll('.schema-faq-section');
            const thisItem = this.parentNode;

            items.forEach((item) => {
                if (thisItem == item) {
                    thisItem.classList.toggle('is-open');
                    return;
                }
                item.classList.remove('is-open');
            });
        }


    }
}