# Monitor

Легковесный инструмент для мониторинга системы, использующий [Lumen](https://github.com/laravel/lumen-framework) и вдохновлённый [eZ Server Monitor](https://github.com/shevabam/ezservermonitor-web) и [Linux Dash](https://github.com/afaqurk/linux-dash).


#Roadmap

- Добавить в API информацию по использованию процессора (командой `grep 'cpu ' /proc/stat | awk '{usage=($2+$4)*100/($2+$4+$5)} END {print usage}'`)
