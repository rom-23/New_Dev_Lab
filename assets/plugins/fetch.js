const secondSuite = document.querySelector('#display-view');
const secondSuite2 = document.querySelector('#display-view2');

function panelView(route) {
    // eslint-disable-next-line func-style
    const getView = async function () {
        try {
            let response = await fetch(route);
            if (response.ok) {
                secondSuite.innerHTML = '';
                secondSuite2.innerHTML = '';
                let data = await response.json();
                secondSuite.innerHTML = data['view'];
            }
        } catch (e) {
            alert(e.message);
        }
    };
    return getView();
}

document.querySelectorAll('.dev_item').forEach(function (link) {
    link.addEventListener('click', function (event) {
        event.preventDefault();
        const route = this.getAttribute('href');
        return panelView(route);

    });
});
