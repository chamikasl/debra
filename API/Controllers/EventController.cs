using System;
using API.Models;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using API.Data;
using System.Linq;
using System.Threading.Tasks;

[ApiController]
[Route("event")]
public class EventController : ControllerBase
{
    private readonly AppDbContext _dbContext;

    public EventController(AppDbContext dbContext)
    {
        _dbContext = dbContext;
    }

    [HttpPost("create")]
    public async Task<IActionResult> CreateEvent([FromBody] EventModel model)
    {
        if (ModelState.IsValid)
        {
            var eventEntity = new EventModel
            {
                id = model.id,
                title = model.title,
                cover_img = model.cover_img,
                description = model.description,
                duration = model.duration,
                end_date = model.end_date,
                date_showing = model.date_showing,
                location = model.location,
                price = model.price,
                partner_id = model.partner_id


            };

            _dbContext.events.Add(eventEntity);

            try
            {
                await _dbContext.SaveChangesAsync();
                return Ok(new { Success = true, Message = "Event created successfully" });
            }
            catch (DbUpdateException ex)
            {
                // Log the exception
                return StatusCode(500, new { Success = false, Message = "An error occurred while creating the event." });
            }
        }

        return BadRequest(new { Success = false, Errors = ModelState.Values.SelectMany(v => v.Errors) });
    }

    [HttpPut("update/{eventId}")]
    public async Task<IActionResult> UpdateEvent(int eventId, [FromBody] EventModel model)
    {
        if (ModelState.IsValid)
        {
            var existingEvent = await _dbContext.events.FindAsync(eventId);

            if (existingEvent == null)
            {
                return NotFound(new { Success = false, Message = "Event not found" });
            }

            // Update properties with new values
            existingEvent.id = model.id;
            existingEvent.title = model.title;
            existingEvent.cover_img = model.cover_img;
            existingEvent.description = model.description;
            existingEvent.duration = model.duration;
            existingEvent.end_date = model.end_date;
            existingEvent.date_showing = model.date_showing;
            existingEvent.location = model.location;
            existingEvent.price = model.price;
            existingEvent.partner_id = model.partner_id;

            try
            {
                await _dbContext.SaveChangesAsync();
                return Ok(new { Success = true, Message = "Event updated successfully" });
            }
            catch (DbUpdateException ex)
            {
                // Log the exception
                return StatusCode(500, new { Success = false, Message = "An error occurred while updating the event." });
            }
        }

        return BadRequest(new { Success = false, Errors = ModelState.Values.SelectMany(v => v.Errors) });
    }

    [HttpDelete("delete/{eventId}")]
    public async Task<IActionResult> DeleteEvent(int eventId)
    {
        var existingEvent = await _dbContext.events.FindAsync(eventId);

        if (existingEvent == null)
        {
            return NotFound(new { Success = false, Message = "Event not found" });
        }

        _dbContext.events.Remove(existingEvent);

        try
        {
            await _dbContext.SaveChangesAsync();
            return Ok(new { Success = true, Message = "Event deleted successfully" });
        }
        catch (DbUpdateException ex)
        {
            // Log the exception
            return StatusCode(500, new { Success = false, Message = "An error occurred while deleting the event." });
        }
    }
}
