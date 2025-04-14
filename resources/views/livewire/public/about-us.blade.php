<div>
    <style>
        .content-description img {
            width: 100% !important;
            height: auto !important;

        }
    </style>
    <main id="content" role="main" class="px-9 content-description">
        @php
            $aboutus =
                defined('system_config') && isset(system_config['aboutUs']) ? system_config['aboutUs']['value'] : '';
        @endphp

        {!! $aboutus !!}
    </main>
</div>
@script
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "FAQPage",
      "mainEntity": [{
        "@type": "Question",
        "name": "What is TechBottle?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "TechBottle is a leading e-commerce marketplace in Sialkot, connecting buyers with trusted sellers across Punjab. We offer a wide range of computers, laptops, peripherals, accessories, networking equipment, and storage devices to meet your tech needs."
        }
      },{
        "@type": "Question",
        "name": "Do you offer delivery services?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Yes! We provide fast and reliable delivery within 24 hours across Sialkot, ensuring a seamless shopping experience."
        }
      },{
        "@type": "Question",
        "name": "Can I find gaming accessories at TechBottle?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Absolutely! We offer gaming keyboards, mice, headsets, cooling fans, graphic cards, PC cases, and other essential gaming accessories to enhance your setup."
        }
      },{
        "@type": "Question",
        "name": "Who are the sellers on TechBottle?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "TechBottle collaborates with verified sellers from across Punjab, giving customers in Sialkot access to a diverse selection of tech products at competitive prices, with delivery in just 24 hours."
        }
      },{
        "@type": "Question",
        "name": "Does TechBottle support freelancers and IT professionals?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Yes! We empower IT professionals, freelancers, and businesses by offering affordable, high-quality tech accessories and hardware solutions to support their work."
        }
      },{
        "@type": "Question",
        "name": "How can I place an order?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Simply visit our website, browse the products, add items to your cart, and proceed to checkout. Our user-friendly platform makes shopping quick and convenient."
        }
      },{
        "@type": "Question",
        "name": "Can I sell my products on TechBottle?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Currently, TechBottle does not offer a selling platform for individuals or businesses. However, we are committed to expanding our services in the future. Stay tuned for updates!"
        }
      },{
        "@type": "Question",
        "name": "What payment methods do you accept?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "We accept Cash on Delivery (COD), online payments, and bank transfers, offering flexibility for a smooth transaction process."
        }
      },{
        "@type": "Question",
        "name": "What if I receive a faulty or incorrect product?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "Customer satisfaction is our priority. If you receive a faulty or incorrect item, contact our support team, and we’ll assist you with a return or exchange."
        }
      },{
        "@type": "Question",
        "name": "How can I contact TechBottle for inquiries?",
        "acceptedAnswer": {
          "@type": "Answer",
          "text": "📧 Email: info@techbottle.pk
    📞 Phone/WhatsApp: 0341-8425578
    📍 Location: Sialkot, Pakistan"
        }
      }]
    }
    </script>
@endscript
