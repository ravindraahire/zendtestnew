<?php
class SearchController extends Zend_Controller_Action
{
	/**
	 * Create Index
	 */
	public function createIndexAction()
	{
		try {
			// Create an index
			$index = Zend_Search_Lucene::create('../application/views/searchindex');

			$artist1 = new Zend_Search_Lucene_Document();
			$artist2 = new Zend_Search_Lucene_Document();
			$artist3 = new Zend_Search_Lucene_Document();
			$artist4 = new Zend_Search_Lucene_Document();
			$artist5 = new Zend_Search_Lucene_Document();

			$artist1->addField(Zend_Search_Lucene_Field::Text('artist_name', 'Paul Oakenfold', 'utf-8'));
			$artist1->addField(Zend_Search_Lucene_Field::Keyword('genre', 'electronic'));
			$artist1->addField(Zend_Search_Lucene_Field::UnIndexed('date_formed', '1990', 'utf-8'));
			$artist1->addField(Zend_Search_Lucene_Field::Text('description', 'Paul Oakenfold description will go here', 'utf-8'));
			$artist1->addField(Zend_Search_Lucene_Field::UnIndexed('artist_id', '1'));
			$artist1->addField(Zend_Search_Lucene_Field::UnStored('full_profile', 'Paul Oakenfold full profile will go here', 'utf-8'));

			$artist2->addField(Zend_Search_Lucene_Field::Text('artist_name', 'Christofer Lowrence', 'utf-8'));
			$artist2->addField(Zend_Search_Lucene_Field::Keyword('genre', 'electronic'));
			$artist2->addField(Zend_Search_Lucene_Field::UnIndexed('date_formed', '1991', 'utf-8'));
			$artist2->addField(Zend_Search_Lucene_Field::Text('description', 'Christofer Lowrence description will go here', 'utf-8'));
			$artist2->addField(Zend_Search_Lucene_Field::UnIndexed('artist_id', '2'));
			$artist2->addField(Zend_Search_Lucene_Field::UnStored('full_profile', 'Christofer Lowrence full profile will go here', 'utf-8'));

			$artist3->addField(Zend_Search_Lucene_Field::Text('artist_name', 'Sting', 'utf-8'));
			$artist3->addField(Zend_Search_Lucene_Field::Keyword('genre', 'rock'));
			$artist3->addField(Zend_Search_Lucene_Field::UnIndexed('date_formed', '1982', 'utf-8'));
			$artist3->addField(Zend_Search_Lucene_Field::Text('description', 'Sting description will go here', 'utf-8'));
			$artist3->addField(Zend_Search_Lucene_Field::UnIndexed('artist_id', '3'));
			$artist3->addField(Zend_Search_Lucene_Field::UnStored('full_profile', 'Sting full profile will go here', 'utf-8'));

			$artist4->addField(Zend_Search_Lucene_Field::Text('artist_name', 'Elton John', 'utf-8'));
			$artist4->addField(Zend_Search_Lucene_Field::Keyword('genre', 'rock'));
			$artist4->addField(Zend_Search_Lucene_Field::UnIndexed('date_formed', '1970', 'utf-8'));
			$artist4->addField(Zend_Search_Lucene_Field::Text('description', 'Elton John description will go here', 'utf-8'));
			$artist4->addField(Zend_Search_Lucene_Field::UnIndexed('artist_id', '4'));
			$artist4->addField(Zend_Search_Lucene_Field::UnStored('full_profile', 'Elton John full profile will go here', 'utf-8'));

			$artist5->addField(Zend_Search_Lucene_Field::Text('artist_name', 'Black Star', 'utf-8'));
			$artist5->addField(Zend_Search_Lucene_Field::Keyword('genre', 'hiphop'));
			$artist5->addField(Zend_Search_Lucene_Field::UnIndexed('date_formed', '1999', 'utf-8'));
			$artist5->addField(Zend_Search_Lucene_Field::Text('description', 'Black Star description will go here', 'utf-8'));
			$artist5->addField(Zend_Search_Lucene_Field::UnIndexed('artist_id', '5'));
			$artist5->addField(Zend_Search_Lucene_Field::UnStored('full_profile', 'Black Star full profile will go here', 'utf-8'));

			$index->addDocument($artist1);
			$index->addDocument($artist2);
			$index->addDocument($artist3);
			$index->addDocument($artist4);
			$index->addDocument($artist5);
			//print_r($index);exit;
			echo 'index created';
			echo 'Total documents: '.$index->maxDoc();			
		} catch(Exception $e) {
			echo $e->getMessage();
		}
		$this->_helper->viewRenderer->setNoRender();
	}

	/**
	 * Update index
	 */
	public function updateIndexAction()
	{
		try {
			// Update an index
			$index = Zend_Search_Lucene::open('../application/views/searchindex');
		} catch(Exception $e) {
			echo $e->getMessage();
		}
		echo 'Index opened for Reading/Updating';
		$this->_helper->viewRenderer->setNoRender();
	}

	/**
	 * Delete the documents
	 */
	public function deleteDocumentAction()
	{
		try {
			$index = Zend_Search_Lucene::open('../application/views/searchindex');
			$hits = $index->find('genre::electronic');
			//Construct Query   
			//$query = 'paul*';   
			//Search.   
			//$hits = $index->find($query);
 
			//print_r($hits);
			foreach ($hits as $hit) {
				echo $hit->artist_name;
				$index->delete($hit->id);
			}
		} catch(Exception $e) {
			echo $e->getMessage();
		}
			echo 'Deletion completed<br/>';
		echo 'Total documents: '.$index->numDocs();

		//Suppress the view
		$this->_helper->viewRenderer->setNoRender(); 
	}

	public function parseHtmlAction()
	{
		try {
			$index = Zend_Search_Lucene::open('../application/views/searchindex');
			$htmlDocPath = '../application/views/searchindex-views/htmlexample.phtml';
			if (!file_exists($htmlDocPath)) {
				throw new Exception("Could not find file $htmlDocPath.");
			}
  			$htmlDoc = Zend_Search_Lucene_Document_Html:: loadHTMLFile ($htmlDocPath);

  			//Example of getters and property calls.
  			$links = $htmlDoc->getLinks();
  			$headerLinks = $htmlDoc->getHeaderLinks();
  			$title = $htmlDoc->title;
  			$body  = $htmlDoc->body;
            //Add the content to the Index.
  			$index->addDocument($htmlDoc);
      		echo 'Successfully parsed HTML file.<br/>';
      		echo 'Total Documents:'. $index->numDocs().'<br/><br/>';
      		//Validate parsed links within document      
      		echo "Links Parsed<br/>";
      		foreach($links as $link) {
         		echo "$link <br/>";
      		}
		} catch (Exception $e) {
			echo $e->getMessage();
		}
		$this->_helper->viewRenderer->setNoRender();
	}

	public function resultAction()
	{
		try {
			$index = Zend_Search_Lucene::open('../application/views/searchindex');
			$index->setDefaultSearchField('artist_name');
			//$index->setResultSetLimit(1);
			//$query = 'stin* AND description : description';
			//$query = 'star*';
			$query = 'full_profile : full profile';
			$query = Zend_Search_Lucene_Search_QueryParser::parse($query);// required to highlight keywords
			$hits = $index->find($query, 'artist_name', SORT_STRING, SORT_ASC);
			$text = '';
			foreach($hits as $hit) {
		        $text .= "<tr>
		        	<td>
		         		<a href='artist/'$hit->artist_id>$hit->artist_name</a> 
		            	$hit->genre
		            	$hit->date_formed
		          	</td>
		        </tr>         
		        <tr><td>$hit->description<br><br></td></tr>";
		    }
		    //echo $text;exit;
		    $text = $query->htmlFragmentHighlightMatches($text);
		} catch(Exception $e) {
			echo $e->getMessage();
		}
		//$this->_helper->viewRenderer->setNoRender();
		//$this->view->hits = $hits;
		$this->view->text = $text;
	}
}