class Project {
    constructor(project) {
        this._id = '';
        this._title = '';
        this._img = '';
        this._visites = [];
        this._population = '';
        this._superficie = '';
        this._id = project.id;
        this._title = project.title;
        this._img = project.img;
        this._visites = project.visites;
        this._population = project.population;
        this._superficie = project.superficie;

    }
    card() {
        this._card = document.createElement('div'); // Pour afficher des données en htlm il faut d'abord créer par exemple la div puis le titre puis mettre un innerText
        this._card.classList.add("card"); // et finalement il faut lui indiquer le appendChild a qui il rapporte pour les associer. L'appendChild sera toujours
        let cardColumns = document.getElementById('projects'); // l'élément qui juste au dessus qui l'englobe
        cardColumns.appendChild(this._card);
    }

    cardHeader() {
        this._cardHeader = document.createElement('div');
        this._cardHeader.classList.add("card-header", "text-center");
        let title = document.createElement('h3');
        title.innerText = `${this._title}`;        
        this._cardHeader.appendChild(title);
        this._card.appendChild(this._cardHeader);
    }
    cardImg() {
        if (this._img != '') {
            this._cardImg = document.createElement('img');
            this._cardImg.classList.add("card-img", "my-1", "border-bottom");
            this._cardImg.src = this._img;
            this._card.appendChild(this._cardImg);
        }
    }
    cardVisites() {
        /*Il faut d'abord créer le ul, puis le rattacher à l'appenchild Card, puis on utilise un tableau afin de boucler sur chaque compétences qui sont dans un pseudo tableau
         et on lui indique qu'il depend de ul */
        if (this._cardVisites != '') {
            this._cardVisites = document.createElement('ul');
            this._cardVisites.classList.add("list-group", "list-group-flush", "m-0", "collapse");
            this._cardVisites.setAttribute('id', `${this._id}`);
            this._card.appendChild(this._cardVisites);
            for (let competence of this._visites) {
                let visites = document.createElement('li');
                visites.classList.add("list-group-item");
                visites.innerText = competence;
                this._cardVisites.appendChild(visites);
            }
        }
    }
    cardButton() {
        if (this._link != '') {
            let button = document.createElement('div');
            button.classList.add("border-bottom");
            this._card.appendChild(button);
            this._cardButton = document.createElement('a');
            this._cardButton.classList.add("btn", "btn-primary", "mx-5", "my-4", "d-flex", "justify-content-center");
            this._cardButton.innerText = 'Voir les lieux � visiter';
            button.setAttribute("data-toggle", "collapse");
            button.setAttribute("data-target", `#${this._id}`);
            button.style.cursor = "pointer";

            button.appendChild(this._cardButton);
        }

    }

    cardFooter() {
        
            this._cardFooter = document.createElement('div');
            this._cardFooter.classList.add("card-footer", "text-muted", "py-2", "text-center", "border-top");
            
            this._cardFooter.innerText = `population : ${this._population} superficie : ${this._superficie}`;
      
            this._card.appendChild(this._cardFooter);
        
    }
    displayCard() {
        this.card();
        this.cardHeader();
        this.cardImg();
        this.cardVisites();
        this.cardButton();
        this.cardFooter();

    }
}
