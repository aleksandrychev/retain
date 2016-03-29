module PragmaticSegmenter
  module Languages
    module Russian
      include Languages::Common

      module Abbreviation
        ABBREVIATIONS = ["y", "y.e", "а", "авт", "адм.-терр", "акад", "в", "вв", "вкз", "вост.-европ", "г", "гг", "гос", "гр", "д", "деп", "дисс", "дол", "долл", "ежедн", "ж", "жен", "з", "зап", "зап.-европ", "заруб", "и", "ин", "иностр", "инст", "к", "канд", "кв", "кг", "куб", "л", "л.h", "л.н", "м", "мин", "моск", "муж", "н", "нед", "о", "п", "пгт", "пер", "пп", "пр", "просп", "проф", "р", "руб", "с", "сек", "см", "спб", "стр", "т", "тел", "тов", "тт", "тыс", "у", "у.е", "ул", "ф", "ч"]
        PREPOSITIVE_ABBREVIATIONS = []
        NUMBER_ABBREVIATIONS = []
      end

      class AbbreviationReplacer < AbbreviationReplacer
        SENTENCE_STARTERS = [].freeze

        private

        def replace_period_of_abbr(txt, abbr)
          txt.gsub!(/(?<=\s#{abbr.strip})\./, '∯')
          txt.gsub!(/(?<=\A#{abbr.strip})\./, '∯')
          txt.gsub!(/(?<=^#{abbr.strip})\./, '∯')
          txt
        end
      end
    end
  end
end
