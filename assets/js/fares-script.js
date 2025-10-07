//<a href="assets/img/portfolio/portfolio-1.webp" class="glightbox preview-link" data-gallery="portfolio-gallery-web"><i class="bi bi-eye"></i></a>
async function loadPortfolio() {
  try {
    // 1. Fetch the JSON file
    const response = await fetch('../../projects.json');
    if (!response.ok) throw new Error("Failed to fetch data");

    // 2. Convert to JS object
    const data = await response.json();

    // 3. Find the container
    const container = document.getElementById('PortfolioItems');
    if (!container) {
      console.error("Container not found!");
      return;
    }

    // 4. Loop through each object in JSON and create HTML
    data.forEach(item => {
      const card = document.createElement('div');
      card.className = 'col-lg-6 col-md-6 portfolio-item isotope-item';

      card.innerHTML = `
        <div class="portfolio-card">
          <div class="portfolio-image">
            <img src="${item.imageSrc}" class="img-fluid" alt="${item.title}" loading="lazy">
            <div class="portfolio-overlay">
              <div class="portfolio-actions">
                <a href="${item.demoLink}" class="Demo-project" target="_blank">
                  <i class="bi bi-arrow-right"> </i>
                </a>
              </div>
            </div>
          </div>
          <div class="portfolio-content">
            <h3>${item.title}</h3>
            <p>${item.body}</p>
            <div class="portfolio-links">
              <a href="${item.codeSource}" target="_blank" title="Source Code">
                <i class="bi bi-github"></i>
              </a>
            </div>
          </div>
        </div>
      `;

      container.appendChild(card);
    });

  } catch (error) {
    console.error("Error loading portfolio:", error);
  }
}

// Run when DOM is ready
document.addEventListener('DOMContentLoaded', loadPortfolio);
