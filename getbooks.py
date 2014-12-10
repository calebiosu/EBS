from bs4 import BeautifulSoup
from mechanize import *

def getBooks():
	f=open('books.csv','w',0)
	f.write('\t'.join(['title', 'author', 'descr', 'ISBN', 'ISBN13', 'genres', 'imagePath']))
	f.write('\n')
	br=Browser()
	br.set_handle_robots(False)
	base_url = 'http://www.goodreads.com'
	
	response = BeautifulSoup( br.open(base_url+'/list/show/33934.Best_Selling_Books_of_All_Time').read() )
	table = response.find( 'table' )
	
	books = table.find_all('tr')
	for book in books:
		info = book.find_all('td')[2]
		link = info.find('a').get('href')
		# get title and author 
		title = info.find('a').find('span').string.strip()
		author = info.find('span', {'itemprop':'author'}).find('a').find('span').string.strip()
		
		response = BeautifulSoup( br.open(base_url+link).read() )
		div = response.find('div', {'class':'leftContainer'})
		
		# get image
		#img = div.find('img')
		#img_res = br.open_novisit(img['src'])
		img_file = '_'.join(title.split(' ')).replace('/','_')+'.jpg'
		#with open('images/'+img_file, 'wb') as f:
		#	f.write(img_res.read())
		
		# get description
		desc_span = div.find('div',{'id':'description'}).find_all('span')
		desc_container = desc_span[1] if len(desc_span) > 1 else desc_span[0]
		descr = '\\n'.join(''.join(desc_container.find_all(text=True)).strip().split('\n'))
		
		# get details
		isbn_ = div.find('div',{'id':'bookDataBox'}).find('div',text='ISBN')
		if isbn_:
			ISBNs = isbn_.parent.find_all('div')[1].find_all(text=True)
			ISBN = ISBNs[0].strip()
			ISBN13 = ISBNs[2].strip()

		# get genres
		genres = []
		divs = response.find_all('div',{'class':'elementList '})
		for each in divs:
			left = ' '.join([element.strip() for element in each.find('div',{'class':'left'}).find_all(text=True) if len(element.strip()) > 0])
			genres.append(left)
		f.write("\t".join([title.encode('utf-8'), author.encode('utf-8'), descr.encode('utf-8'), ISBN.encode('utf-8'), ISBN13.encode('utf-8'), ",".join(genres).encode('utf-8'), img_file.encode('utf-8')]))
		f.write('\n')
	f.close()


if __name__ == '__main__':
	getBooks()