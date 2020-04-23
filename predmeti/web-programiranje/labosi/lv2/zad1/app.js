/**
 * Rješenje zadatka postavite ovdje
 */

class App {
    async fetchBooks() {
        const url = 'https://www.anapioficeandfire.com/api/books';
        const response = await fetch(url)
        return response.json()
    }
    
    async main() {
        const books = await this.fetchBooks()
        const marginDate = '2007-01-01T00:00:00';
        const after2006 = books.filter(book => book.released >= marginDate)
        
        const after2006Names = after2006.map(book => book.name)
        console.log(after2006Names)
        
        const sumOfPages = after2006.reduce((sum, book) => sum + book.numberOfPages, 0)
        console.log(sumOfPages)
    }
}

const app = new App();
app.main();
