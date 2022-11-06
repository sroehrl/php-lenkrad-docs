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

/* highlght text*/

function highlightText(element, textToHighlight){
    const reg = new RegExp('(>.*)' + textToHighlight + '([^<]*)', 'ig');

    element.innerHTML = element.innerHTML.replace(reg, '$1<span class="bg-accent-dark">'+ textToHighlight + '</span>$2');
}


function alpineHighlightText(text, replacement){
    const reg = new RegExp(replacement, 'ig');
    return text.replace(reg, (match) => `<span class="bg-accent-dark">${match}</span>`)
}

/* query reader*/

class UrlParser{
    constructor() {
        this.params = new URLSearchParams(window.location.search)
    }
    get(name) {
        return this.params.get(name)
    }
}

const url = new UrlParser();
if(url.get('highlight')) {
    highlightText(document.getElementById('layout-content'), url.get('highlight'))
    const firstHit = document.evaluate('//*[text()="' + url.get('highlight') + '"]', document, null, XPathResult.ORDERED_NODE_SNAPSHOT_TYPE).snapshotItem(0);
    if(firstHit){
        setTimeout(()=>{
            firstHit.scrollIntoView({behavior:"smooth", block: "center"})
        }, 300)

    }
}