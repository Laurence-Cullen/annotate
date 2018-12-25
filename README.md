# laravel_annotate
An image search engine which uses object detection to tag images for searching for images of objects.
Includes type ahead and 'did you mean?' corrections for a friendly search experience.

Set up as you would a standard laravel project, there is one external dependancy, the Darknet ml framework.


To install Darknet run:

```
cd ~/
git clone https://github.com/pjreddie/darknet.git
cd darknet
make
```

To test the darknet install run:<br/>
```
./darknet
```

You should get the output:<br/>
```
usage: ./darknet <function>
```

if the install has completed successfully.
If you hit any problems during the install take a look at the darknet [project page](https://pjreddie.com/darknet/install/).
