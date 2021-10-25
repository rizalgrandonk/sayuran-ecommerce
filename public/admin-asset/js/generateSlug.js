const judul = document.querySelector(".slug-from");
const slug = document.querySelector(".slug-field");

const generateSlug = () => {
    const originalPathArray = window.location.pathname.split("/");
    const destinationPath = [...originalPathArray.slice(0, 3), "slug"].join(
        "/"
    );
    console.log(destinationPath);

    fetch(`${destinationPath}?from=${judul.value}`, {
        headers: {
            Accept: "application/json",
        },
    })
        .then((res) => res.json())
        .then((data) => (slug.value = data.slug))
        .catch((err) => console.log(err));
};

judul.addEventListener("change", () => {
    generateSlug();
});
