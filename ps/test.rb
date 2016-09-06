require "pragmatic_segmenter"

text = "Hello world. My name is Mr. Smith. I work for the U.S. Government and I live in the U.S. I live in New York."
ps = PragmaticSegmenter::Segmenter.new(text: text)
puts ps.segment
