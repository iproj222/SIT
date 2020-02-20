select reason_note , count(reason_note)
from leaves
group by reason_note;