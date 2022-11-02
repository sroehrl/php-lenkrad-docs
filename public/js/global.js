/* ====== Primitive scroll spy ======= */
class ScrollSpy {
    constructor(element) {
        this.element = element
        this.element.style.display = "none"
        window.onscroll = () => {
            this.element.style.display = (document.body.scrollTop > 30 || document.documentElement.scrollTop > 30) ? "block" : "none"
        }
    }
}

function backToTop() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

document.querySelectorAll('.scroll-spy').forEach(element => {
    new ScrollSpy(element)
})

/* ====== Code normalisation ======= */
window.Prism = window.Prism || {};
function highlightCode(){
    //<script src="assets/plugins/prism/prism.js"></script>


    document.querySelectorAll('[class^=language-]').forEach(element => {
        // remove prism



        let found = false;
        let spaces = '';
        let finalString = '';
        const rows = element.innerHTML.split("\n");
        console.log(rows)
        rows.forEach(row => {
            if(!found && row.trim().length>0){
                found = true;
                spaces = row.match(/^\s+/)[0]
            }
        })
        for(let i = 0; i < rows.length; i++){
            finalString += rows[i].substring(spaces.length) + "\n";
        }
        const codetag = document.createElement('code')
        codetag.className = element.dataset.class
        codetag.innerHTML = finalString.replace('<span class="token operator">?</span>php','<span class="token operator">&lt;?</span>php');

        element.innerHTML = '';
        element.appendChild(codetag)
        Prism.highlightAll()


    })



}
setTimeout(highlightCode, 300)