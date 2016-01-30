# Markdown Extra

This CodeIgniter package/spark transforms markdown to HTML.

It uses [Michel Fortin][michel]'s extra branch of 
the [php-markdown library][php-markdown], version 1.2.5, see also Notes.

[Kenny Katzgrau][kenny]'s markdown spark served me as blueprint.

Current version number 0.0.1


## Usage

The package/spark consists of one helper function, parse\_markdown_extra(), which accepts a block of markdown (extra), and returns HTML. 
You can install it either as package or as spark.

### As spark

Load the spark and call the parse\_markdown_extra() function.

	# x.x.x is the version number
	$this->load->spark('markdown/x.x.x');
	$html = parse_markdown_extra($some_markdown_string);

### As package

Add the package path, load the helper and call the parse\_markdown_extra() function.

	$this->load->add_package_path('path/to/the/markdown/package');
	$this->load->helper('markdown-extra');
	$html = parse_markdown_extra($some_markdown_string);

## Support

Send any questions to [Thomas Traub][thomas]. 

## Source

The original package code: [ci-pkg-markdown-extra][ci-pkg-markdown-extra]  
The deployment as CodeIgniter Spark: [ci-spark-markdown-extra][ci-spark-markdown-extra]

## Notes

January 30, 2012

* I include Michel Fortin's library as submodule. Michel used to tag every version (prefix x for the extra versions), but the for [current 1.2.5 release][php-markdown-project] there is no tag set, the HEAD of the extra branch matches the download version.
* getsparks.org does not (yet) support submodules, therefore the separation into two repos.

[ci-pkg-markdown-extra]: https://bitbucket.org/tomcode/ci-pkg-markdown-extra
[ci-spark-markdown-extra]: https://github.com/tomcode/ci-spark-markdown-extra
[package-repo]: mailto:tt@thomastraub.com
[thomas]: mailto:tt@thomastraub.com
[kenny]: http://twitter.com/_kennyk_
[michel]: http://michelf.com/
[php-markdown]: https://github.com/michelf/php-markdown
[php-markdown-project]: http://michelf.com/projects/php-markdown/