window.addEventListener("load", function () {
    let projectList = [];
    //Récup projets
    fetch('projects.json').then((result) => {
        result.json()
            .then(function (projects) {
            build(projects);
            filtreSkill();
            creationBadge();
        });
    });
    //Créer les objets
    let build = (projects) => {
        for (let json_project of projects) {
            let project = new Project(json_project);
            projectList.push(project);
            project.displayCard();
        }
    };
   
   
    document.getElementById('alphabetique').addEventListener('click', function () {
        console.log('tri alpha');
        // fonction permetttant de trier les id de chaque objet par ordre alpha
        projectList.sort(function (a, b) {
            let nameA = a._id.toLowerCase(), nameB = b._id.toLowerCase();
            if (nameA < nameB) //sort string ascending
                return -1;
            if (nameA > nameB)
                return 1;
            return 0; //default return value (no sorting)
        });
        // permet de supprimer tous les élement présent dans la div projets afin de pouvoir les réafficher dans le bon odre
        let triAlpha = document.getElementById("projects");
        triAlpha.innerHTML = '';
        // Il faut boucler sur tous les objets de projectList puis assigner à chaque objet la méthode displayCard qui permet de réafficher les éléement sur la page web
        for (let element of projectList) {
            element.displayCard();
        }
    });
   
  
});
