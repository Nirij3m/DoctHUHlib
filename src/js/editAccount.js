img.onchange = evt => {
    const [file] = img.files
    if (file) {
        pfp.src = URL.createObjectURL(file)
    }
}