select reason_note , count(reason_note)
from leaves
group by reason_note;

select DATEDIFF(l.period, e.join_date), l.last_position
from leaves as l
join employees as e
on l.employee_number = e.employee_number
where e.join_date is not null 
and DATEDIFF(l.period, e.join_date) > 0;


select last_position , count(last_position)
from leaves as l
join employees as e
on l.employee_number = e.employee_number
where e.join_date is not null 
and DATEDIFF(l.period, e.join_date) <= 365
and DATEDIFF(l.period, e.join_date) > 0
group by (l.last_position);

select l.last_position , count(l.last_position)
from leaves as l
join employees as e
on l.employee_number = e.employee_number
where e.join_date is not null 
and DATEDIFF(l.period, e.join_date) > 365
and DATEDIFF(l.period, e.join_date) <= 730
group by (l.last_position);

select l.last_position , count(l.last_position)
from leaves as l
join employees as e
on l.employee_number = e.employee_number
where e.join_date is not null 
and DATEDIFF(l.period, e.join_date) > 730
group by (l.last_position);

CREATE VIEW all_avg_view as
select employee_number as "id",avg(TIMESTAMPDIFF(MINUTE,checkin,checkout)) as "avg" 
from checkin_outs
where checkin is not null 
and checkout is not null 
and checkin > 0
and checkout > 0
group by employee_number;


CREATE VIEW avg_view as
select leaves.employee_number as "id",avg(TIMESTAMPDIFF(MINUTE,checkin,checkout)) as "avg"
from checkin_outs
join leaves
on leaves.employee_number = checkin_outs.employee_number
where checkin is not null 
and checkout is not null 
and checkin > 0
and checkout > 0
group by leaves.employee_number;

select count(id)
from(
    select leaves.employee_number as "id",avg(TIMESTAMPDIFF(MINUTE,checkin,checkout)) as "avg"
    from checkin_outs
    join leaves
    on leaves.employee_number = checkin_outs.employee_number
    where checkin is not null 
    and checkout is not null 
    and checkin > 0
    and checkout > 0
    group by leaves.employee_number)
where avg < 240;

select count(id) 
from avg_view
where avg >= 600;

select count(id) 
from all_avg_view
where avg >= 540;